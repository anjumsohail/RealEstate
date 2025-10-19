  <section>
      <div class="tab-content tabbed_widget clearfix">
          <div class="tab-pane active" id="tab1">
              <h3 class="mid_title"> List of Properties</h3>
              <div class="table-responsive">
                  <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="dataTables_length" id="dataTables-example_length">
                                  <label><select wire:model.live="perPage" name="dataTables-example_length"
                                          aria-controls="dataTables-example" class="form-control input-sm">
                                          <option value="10">5</option>
                                          <option value="10">10</option>
                                          <option value="25">25</option>
                                          <option value="50">50</option>
                                          <option value="100">100</option>
                                      </select> records per page</label>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div id="dataTables-example_filter" class="dataTables_filter">
                                  <label>Search:<input wire:model.live="search" type="search"
                                          class="form-control input-sm" aria-controls="dataTables-example"></label>
                              </div>
                          </div>
                      </div>

                      <div class="table-responsive">
                          <table class="table table-bordered border-primary">
                              <thead>
                                  <tr>
                                      <th scope="col">SNo#</th>
                                      <th scope="col">Property Title</th>
                                      <th scope="col">
                                          <div class="btn-group dropdown">
                                              <button wire:click="toggleSort('proptype')" type="button" class="btn ">
                                                  Type
                                              </button>
                                              <button type="button" class="btn  dropdown-toggle dropdown-toggle-split"
                                                  data-bs-toggle="dropdown" aria-expanded="false">
                                              </button>
                                              <ul class="dropdown-menu">
                                                  @foreach ($type as $item)
                                                      <li class="nav-item">
                                                          <a href="#"
                                                              wire:click.prevent="setType('{{ $item }}')"
                                                              class=" dropdown-item  {{ $filterType === $item ? 'active' : '' }}">{{ $item }}</a>
                                                      </li>
                                                  @endforeach

                                              </ul>
                                          </div>
                                      </th>
                                      <th scope="col">
                                          <div class="btn-group dropdown">
                                              <button wire:click="toggleSort('category')" type="button" class="btn ">
                                                  Category
                                              </button>
                                              <button type="button" class="btn  dropdown-toggle dropdown-toggle-split"
                                                  data-bs-toggle="dropdown" aria-expanded="false">

                                              </button>
                                              <ul class="dropdown-menu">
                                                  @foreach ($category as $item)
                                                      <li class="nav-item">
                                                          <a href="#"
                                                              wire:click.prevent="setCategory('{{ $item }}')"
                                                              class="dropdown-item {{ $filterCategory === $item ? 'active' : '' }}">{{ $item }}</a>

                                                      </li>
                                                  @endforeach
                                              </ul>
                                          </div>

                                      </th>
                                      <th scope="col">
                                          <div class="btn-group dropdown">
                                              <button wire:click="toggleSort('purpose')" type="button" class="btn ">
                                                  Purpose
                                              </button>
                                              <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
                                                  data-bs-toggle="dropdown" aria-expanded="false">

                                              </button>
                                              <ul class="dropdown-menu">
                                                  @foreach ($purpose as $item)
                                                      <li class="nav-item">
                                                          <a href="#"
                                                              wire:click.prevent="setPurpose('{{ $item }}')"
                                                              class="dropdown-item {{ $filterPurpose === $item ? 'active' : '' }}">{{ $item }}</a>

                                                      </li>
                                                  @endforeach

                                              </ul>
                                          </div>

                                      </th>
                                      <th scope="col">
                                          <div class="btn-group dropdown">
                                              <button wire:click="toggleSort('approved')" type="button" class="btn ">
                                                  Status
                                              </button>
                                              <button type="button" class="btn  dropdown-toggle dropdown-toggle-split"
                                                  data-bs-toggle="dropdown" aria-expanded="false">

                                              </button>
                                              <ul class="dropdown-menu">
                                                  @foreach ($status as $item)
                                                      <li class="nav-item">
                                                          <a href="#"
                                                              wire:click.prevent="setStatus('{{ $item }}')"
                                                              class="dropdown-item {{ $filterStatus === $item ? 'active' : '' }}">{{ $item }}</a>

                                                      </li>
                                                  @endforeach

                                              </ul>
                                          </div>

                                      </th>
                                      <th scope="col">
                                          <button wire:click="toggleSort('created_at')" type="button" class="btn ">
                                              Date
                                          </button>

                                      </th>
                                      <th scope="col">Size</th>
                                      <th scope="col">Address</th>
                                      <th scope="col">Price</th>


                                      <th scope="col">Actions</th>
                                  </tr>
                              </thead>
                              <tbody class="table-group-divider">
                                  @foreach ($properties as $property)
                                      <tr wire:key="{{ $property->id }}">
                                          <td>{{ $loop->iteration }}</th>
                                          <td>{{ $property->title }}</th>
                                          <td>{{ $property->proptype }}</th>
                                          <td>{{ $property->category }}</th>
                                          <td>{{ $property->purpose }}</th>
                                          <td>{{ $property->approved == 1 ? 'Approved' : 'Pending' }}</th>
                                          <td>{{ $property->created_at }}</th>
                                          <td>{{ $property->area_size }}-{{ $property->size_unit }}</th>
                                          <td>{{ $property->address }}</th>
                                          <td>{{ $property->demand_price }}</th>

                                          <td>
                                              <button wire:click="showDetail({{ $property->id }})"
                                                  class="btn btn-xs btn-system border-btn btn-green"
                                                  title="View Property"><i class="fa fa-search"></i></button>
                                              <a href="{{ route('property.edit', ['propertyid' => $property->id]) }}"
                                                  class="btn " title="Edit Property"><i
                                                      class="fa fa-pencil-square-o"></i></a>
                                              <button wire:click="deleteProperty({{ $property->id }})"
                                                  wire:confirm="Are you sure you want to delete this post?"
                                                  class="btn " title="Delete Property"><i
                                                      class="fa fa-times-circle-o"></i></button>
                                          </td>

                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>


                      <div class="row">
                          {{ $properties->links('vendor.livewire.bootstrap') }}
                      </div>
                  </div>
              </div>

          </div>
          <div class="tab-pane" id="tab2">
              <h3 class="mid_title"> Inactive Properties (Waiting for Approval)</h3>
              <p class="alert alert-success"><i class="fa fa-exclamation-circle"></i> You
                  have no inactive Property ! Would you like market your property here add
                  now
                  <b><a href="https://www.pins.pk/property/post">Post Your Property</a></b>
                  Its Free !
              </p>
              <hr>
          </div>
      </div>
  </section>
