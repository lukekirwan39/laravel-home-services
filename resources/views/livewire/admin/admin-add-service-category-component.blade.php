<div>

    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Add Service Categories</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>/</li>
                        <li>Add Service Categories</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="content-central">
        <div class="content_info">
            <div class="paddings-mini">
                <div class="container">
                    <div class="row portfolioContainer">
                        <div class="col-md-8 col-md-offset-2 profile1">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                  <div class="row">
                                      <div class="col-md-6">
                                          Add Service Category
                                      </div>
                                      <div class="col-md-6">
                                          <a href="{{route('admin.service_categories')}}" class="btn btn-info pull-right">All Categories</a>
                                      </div>

                                  </div>

                              </div>
                                <div class="panel-body">
                                    @if(session()->has('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <form class="form-horizontal" wire:submit.prevent="createNewCategory">
                                        @csrf
                                        <div class="form-group">
                                             <label for="name" class="control-label col-sm-3">Category Name: </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" wire:model="name" wire:keyup="generateSlug"/>
                                                @error('name') <p class="text-danger">{{$message}}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="slug" class="control-label col-sm-3">Category Slug: </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="slug" wire:model="slug"/>
                                                @error('slug') <p class="text-danger">{{$message}}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="control-label col-sm-3">Category Image: </label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control-file" name="image" wire:model="image"/>
                                                @error('image') <p class="text-danger">{{$message}}</p> @enderror
                                                @if($image)
                                                    <img src="{{$image->temporaryUrl()}}" width="60" />
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right">Add Category</button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
