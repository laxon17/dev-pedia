<x-admin-layout>
    <!-- Content Row -->
    <div class="row">

        <!-- Posts -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Posts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Post::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-pen fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Writers -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Writers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\User::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments -->

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Comments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Comment::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Categories</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Category::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-brands fa-stack-overflow fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Visits Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Social Network Sharing Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Instagram
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Twitter
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Facebook
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Posts By Category</h6>
                </div>
                <div class="card-body overflow-auto" style="height: 600px">
                    @foreach (\App\Models\Category::all() as $category)
                        <h4 class="small font-weight-bold">{{ $category->title }}
                            <span class="float-right">{{ $category->posts()->count() }}</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $category->posts()->count() }}%"
                                aria-valuenow="{{ $category->posts()->count() }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">

            <!-- Latest post -->
            @php
                $post = \App\Models\Post::latest()->firstOrFail();
            @endphp
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Latest Post</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 250px"
                            src="{{ asset('storage/' . $post->thumbnail ) }}" alt="Post's thumbnail" />
                    </div>
                    <div class="mb-3"><h2>{{ $post->title }}</h2> by: {{ $post->user->username }}, {{ $post->created_at->diffForHumans() }}</div>
                    <p>{{ $post->excerpt }}</p>
                    <a target="_blank" rel="nofollow" href="{{ route('posts.show', [ 'post' => $post->slug ]) }}">View whole post</a>
                </div>
            </div>
            
            @php
                $post = \App\Models\Post::withCount('comments')->orderBy('comments_count', 'desc')->firstOrFail()
            @endphp
            <!-- Most Commented post -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Most Commented Post</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 250px"
                            src="{{ asset('storage/' . $post->thumbnail ) }}" alt="Post's thumbnail" />
                    </div>
                    <div class="mb-3"><h2>{{ $post->title }}</h2> by: {{ $post->user->username }}, {{ $post->created_at->diffForHumans() }}</div>
                    <p>{{ $post->excerpt }}</p>
                    <a target="_blank" rel="nofollow" href="{{ route('posts.show', [ 'post' => $post->slug ]) }}">View whole post</a>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>