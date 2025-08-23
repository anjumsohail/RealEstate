(async function extractHierarchy() {
  const delay = ms => new Promise(res => setTimeout(res, ms));
  const escapeSql = str => str.replace(/'/g, "''");

  const citySelect = document.querySelector('#cityid');
  const areaSelect = document.querySelector('#areaid');

  let townSql = "INSERT INTO town (id, name, city_id) VALUES\n";
  let sectorSql = "INSERT INTO sector (id, name, town_id) VALUES\n";
  let blockSql = "INSERT INTO block (id, name, sector_id) VALUES\n";

  for (let i = 0; i < citySelect.options.length; i++) {
    const cityOpt = citySelect.options[i];
    const cityId = parseInt(cityOpt.value);
    const cityName = cityOpt.textContent.trim();

    if (isNaN(cityId) || cityId <= 0) continue;

    console.log(`📍 Processing City: ${cityName} (ID: ${cityId})`);
	//debugger;

    // Select city and trigger getArea(cityId)
    citySelect.value = cityId;
    citySelect.dispatchEvent(new Event('change'));
    citySelect.dispatchEvent(new Event('input')); // extra just in case

    await delay(2000); // Wait for towns to load

    // Re-select areaSelect because it might be replaced dynamically
    const areaSelectUpdated = document.querySelector('#areaid');
    if (!areaSelectUpdated) {
      console.warn(`⚠️ #areaid select not found after selecting city ${cityId}, skipping city.`);
      continue;
    }

    console.log('Town options length:', areaSelectUpdated.options.length);

    for (let j = 0; j < areaSelectUpdated.options.length; j++) {
      const areaOpt = areaSelectUpdated.options[j];
      const townId = parseInt(areaOpt.value);
      const townName = areaOpt.textContent.trim();

      if (!townId || townId <= 0) continue;

      console.log(`📍 Processing Town: ${townName} (ID: ${townId})`);

      townSql += `(${townId}, '${escapeSql(townName)}', ${cityId}),\n`;
	//  debugger;

      // Select town and trigger getProject(townId)
      areaSelectUpdated.value = townId;
      areaSelectUpdated.dispatchEvent(new Event('change'));
      areaSelectUpdated.dispatchEvent(new Event('input'));

      await delay(2000); // Wait for sectors to load

      // Re-select projSelect dynamically
      const projSelect = document.querySelector('#projid');
      if (!projSelect) {
        console.warn(`⚠️ #projid select not found after selecting town ${townId}, skipping sectors.`);
        continue;
      }

      console.log('Sector options length:', projSelect.options.length);

      if (projSelect.options.length === 0) {
        console.warn(`⚠️ No sectors loaded for Town ID ${townId} (${townName}), skipping sectors.`);
        continue;
      }
	//debugger;
      for (let k = 0; k < projSelect.options.length; k++) {
        const projOpt = projSelect.options[k];
        const sectorId = parseInt(projOpt.value);
        const sectorName = projOpt.textContent.trim();

        if (!sectorId || sectorId <= 0) continue;

        console.log(`📍 Processing Sector: ${sectorName} (ID: ${sectorId})`);

        sectorSql += `(${sectorId}, '${escapeSql(sectorName)}', ${townId}),\n`;

        // Select sector and trigger getBlock(sectorId)
        projSelect.value = sectorId;
        projSelect.dispatchEvent(new Event('change'));
        projSelect.dispatchEvent(new Event('input'));

        await delay(2000); // Wait for blocks to load

        // Re-select blkSelect dynamically
        const blkSelect = document.querySelector('#blkid');
        if (!blkSelect) {
          console.warn(`⚠️ #blkid select not found after selecting sector ${sectorId}, skipping blocks.`);
          continue;
        }

        console.log('Block options length:', blkSelect.options.length);

        if (blkSelect.options.length === 0) {
          console.warn(`⚠️ No blocks loaded for Sector ID ${sectorId} (${sectorName}), skipping blocks.`);
          continue;
        }
//debugger;
        for (let l = 0; l < blkSelect.options.length; l++) {
          const blkOpt = blkSelect.options[l];
          const blockId = parseInt(blkOpt.value);
          const blockName = blkOpt.textContent.trim();
//debugger;
          if (!blockId || blockId <= 0) continue;

          console.log(`📍 Processing Block: ${blockName} (ID: ${blockId})`);

          blockSql += `(${blockId}, '${escapeSql(blockName)}', ${sectorId}),\n`;
        }
      }
    }
  }

  // Finalize SQL by trimming trailing comma and adding semicolon
  townSql = townSql.trim().replace(/,\s*$/, ';');
  sectorSql = sectorSql.trim().replace(/,\s*$/, ';');
  blockSql = blockSql.trim().replace(/,\s*$/, ';');

  // Output the results
  console.log('--- 🏙️ Towns SQL ---\n' + townSql);
  console.log('--- 🏗️ Sectors SQL ---\n' + sectorSql);
  console.log('--- 🧱 Blocks SQL ---\n' + blockSql);

  // Optional: copy to clipboard
  /*
  navigator.clipboard.writeText(townSql + '\n\n' + sectorSql + '\n\n' + blockSql).then(() => {
    console.log("✅ SQL copied to clipboard!");
  });
  */
})();
