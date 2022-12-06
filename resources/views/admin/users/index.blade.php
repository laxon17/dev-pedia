<x-admin-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold mb-4 text-primary">Registered Users</h6>
            <div id="successBox" class="alert alert-success" style="display: none"></div>
        </div>
        <div class="card-body">
            <div class="table-responsive overflow-hidden">
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
                            <td class="text-uppercase font-weight-bold">Options</td>
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
                                <td class="text-center">
                                    <i class="fa-solid fa-2xl fa-caret-down optionsTrigger" style="cursor: pointer"></i>
                                </td>
                            </tr>
                            <tr id="optionsRow" style="display: none">
                                <td class="text-center" colspan="8">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <form class="d-flex align-items-center justify-content-center mr-4" action="{{ route('admin.change-role', [ 'user' => $user->id ]) }}">
                                            @php
                                                $isAdmin = $user->role === 'Administrator'
                                            @endphp
                                            @csrf
                                            <input type="hidden" name="role" value="{{ $isAdmin ? 'Moderator' : 'Administrator' }}" />
                                            <button class="roleButton btn btn-{{ $isAdmin ? 'danger' : 'success' }}" {{ $user->is(auth()->user()) ? 'disabled' : '' }}>
                                                {{ $isAdmin ? 'Demote' : 'Promote' }} {{ $user->name }} to {{ $isAdmin ? 'Moderator' : 'Administrator' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.users.destroy', [ 'user' => $user->id ]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger deleteButton" {{ $user->is(auth()->user()) ? 'disabled' : '' }}>Delete User</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <script>
                        const optionsTrigger = document.querySelectorAll('.optionsTrigger')
                        const submitButtons = document.querySelectorAll('.roleButton')
                        const deleteButtons = document.querySelectorAll('.deleteButton')
                        const roleSelections = document.querySelectorAll('.roleSelection')

                        optionsTrigger.forEach(trigger => {
                            trigger.addEventListener('click', (event) => {
                                let optionRow = event.target.parentElement.parentElement.nextElementSibling
                                if(optionRow.style.display === 'none') optionRow.style.display = 'table-row'
                                else optionRow.style.display = 'none'
                            })
                        })

                        deleteButtons.forEach(button => {
                            button.addEventListener('click', (event) => {
                                event.preventDefault()

                                if(confirm('Are you sure you want to delete this user?')) {
                                    let optionsRowToDelete = event.target.parentElement.parentElement.parentElement.parentElement
                                    let userRowToDelete = event.target.parentElement.parentElement.parentElement.parentElement.previousElementSibling
                                    let userToDelete = event.target.parentElement.parentElement.parentElement.parentElement.previousElementSibling.children[0].innerText
                                    let messageBox = document.querySelector('#successBox')

                                    fetch(`/admin/users/${userToDelete}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-Token': document.querySelector('[name="_token"]').value
                                        }
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            messageBox.style.display = 'block'
                                            messageBox.innerText = data.success
                                            setTimeout(() => {
                                                messageBox.style.display = 'none'
                                                messageBox.innerText = ''
                                            }, 3000);
                                            userRowToDelete.style.display = 'none'
                                            optionsRowToDelete.style.display = 'none'
                                        })
                                }
                                
                            })
                        })

                        submitButtons.forEach(button => {
                            button.addEventListener('click', (event) => {
                                event.preventDefault()
                                let token = document.querySelector('[name="_token"]').value
                                let roleToUpdate = event.target.parentElement.children[1].value
                                let userToUpdate = event.target.parentElement.parentElement.parentElement.parentElement.previousElementSibling.children[0].innerText
                                let previousRole = event.target.parentElement.parentElement.parentElement.parentElement.previousElementSibling.children[4]

                                fetch(`/admin/users/${userToUpdate}/change-role`,
                                {
                                    method: 'PATCH',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-Token': token
                                    },
                                    body: JSON.stringify({
                                        'role': roleToUpdate
                                    })
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if(data.user.role === 'Administrator') {
                                            button.classList.replace('btn-success', 'btn-danger')
                                            button.innerText = `Demote ${data.user.name} to Moderator`
                                            previousRole.innerText = 'Administrator'
                                        } else {
                                            button.classList.replace('btn-danger', 'btn-success')
                                            button.innerText = `Promote ${data.user.name} to Administrator`
                                            previousRole.innerText = 'Moderator'
                                        }
                                    })
                            })
                        })
                    </script>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>