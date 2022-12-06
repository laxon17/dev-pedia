<x-admin-layout>
    <div class="d-flex mb-2">
        <h3 class="mr-4">Add new category:</h3>
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div class="d-flex">
                <input type="text" name="title" class="form-control mr-2" placeholder="e.g. React Framework" id="categoryField" />
                <button class="mr-2 btn btn-success">Add</button>
            </div>
        </form>
        @error('title')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Available Categories</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive overflow-hidden">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <td class="text-uppercase font-weight-bold">Title</td>
                            <td class="text-uppercase font-weight-bold">Slug</td>
                            <td class="text-uppercase font-weight-bold">Post Count</td>
                            <td class="text-uppercase font-weight-bold">Created At</td>
                            <td class="text-uppercase font-weight-bold">Delete</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                               <td>{{ $category->title }}</td>
                               <td>{{ $category->slug }}</td>
                               <td>{{ $category->posts()->count() }}</td>
                               <td>{{ $category->created_at->diffForHumans() }}</td>
                               <td class="text-center">
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">X</button>
                                    <form action="{{ route('admin.categories.destroy', [ 'category' => $category->id ]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title">Delete {{ $category->title }}</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <p>Are you sure you want to delete this category?</p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-danger">Remove</button>
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                    </form>
                               </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>