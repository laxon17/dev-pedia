<x-admin-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Available Categories</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <td class="text-uppercase font-weight-bold">Title</td>
                            <td class="text-uppercase font-weight-bold">Slug</td>
                            <td class="text-uppercase font-weight-bold">Post Count</td>
                            <td class="text-uppercase font-weight-bold">Created At</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                               <td>{{ $category->title }}</td>
                               <td>{{ $category->slug }}</td>
                               <td>{{ $category->posts()->count() }}</td>
                               <td>{{ $category->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>