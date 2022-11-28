<x-admin-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User activities</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <td class="text-uppercase font-weight-bold">Subject</td>
                            <td class="text-uppercase font-weight-bold">Event</td>
                            <td class="text-uppercase font-weight-bold">Causer Type</td>
                            <td class="text-uppercase font-weight-bold">Causer</td>
                            <td class="text-uppercase font-weight-bold">Happened</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $activity->subject_type }}</td>
                                <td>{{ $activity->event }}</td>
                                <td>{{ $activity->causer_type ?? 'App\Models\User' }}</td>
                                <td>{{ \App\Models\User::findOrFail($activity->causer_id ?? 2)->username }}</td>
                                <td>{{ $activity->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>