<x-admin-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User reports</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive overflow-hidden">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <td class="text-uppercase font-weight-bold">Post Id</td>
                            <td class="text-uppercase font-weight-bold">Report Reason</td>
                            <td class="text-uppercase font-weight-bold">Post Owner</td>
                            <td class="text-uppercase font-weight-bold">Reporter</td>
                            <td class="text-uppercase font-weight-bold">Take a Look</td>
                            <td class="text-uppercase font-weight-bold">Reported</td>
                            <td class="text-uppercase font-weight-bold">Resolve</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->post_id }}</td>
                                <td>{{ $report->reason }}</td>
                                <td>{{ $report->post->user->name ?? 'Deleted post' }}</td>
                                <td>{{ $report->user->name }}</td>
                                <td>
                                    <a target="_blank" href="{{ ! is_null($report->post) ? route('posts.show', [ 'post' => $report->post->slug ]) : '' }}">{{ $report->post->title ?? 'Deleted post' }}</a>
                                </td>
                                <td>{{ $report->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('reports.update', ['report' => $report->id ]) }}">
                                        @csrf
                                        @method('patch')
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
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