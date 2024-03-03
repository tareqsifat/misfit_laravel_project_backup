<div class="d-flex flex-column flex-shrink-0 p-3 bg-light h-100" style=" border: 2px solid darkgreen; height: 93vh!important;">
    <ul class="nav nav-pills flex-column mb-auto flex-grow-1">
        <li class="nav-item">
            <a href="{{ route('teammates.index') }}" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                Teammate
            </a>
        </li>
        <li>
            <a href="{{ route('projects.index') }}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                Project
            </a>
        </li>
        <li>
            <a href="{{ route('tasks.index') }}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Task
            </a>
        </li>
    </ul>
</div>
