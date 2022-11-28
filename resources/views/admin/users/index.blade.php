<x-admin-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registered Users~</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <td class="text-uppercase font-weight-bold">Id</td>
                            <td class="text-uppercase font-weight-bold">Name</td>
                            <td class="text-uppercase font-weight-bold">Username</td>
                            <td class="text-uppercase font-weight-bold">Email</td>
                            <td class="text-uppercase font-weight-bold">Role</td>
                            <td class="text-uppercase font-weight-bold">Post Count</td>
                            <td class="text-uppercase font-weight-bold">Joined</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                               <td>{{ $user->id }}</td>
                               <td>{{ $user->name }}</td>
                               <td>{{ $user->username }}</td>
                               <td>{{ $user->email }}</td>
                               <td>{{ $user->role }}</td>
                               <td>{{ $user->posts()->count() }}</td>
                               <td>{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>