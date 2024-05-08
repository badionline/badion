<div class="col-sm">
    <a href="{{ route($url) }}">
        <div class="card flex-row dark">
            <img class="card-img-left example-card-img-responsive" src="{{ $img }}"
                style="height: 100px;width: 100px;" />
            <div class="card-body light">
                <h4 class="card-title h5 h4-sm">{{ $title }}</h4>
                <p class="card-text" id="{{ $value }}"></p>
            </div>
        </div>
    </a>
</div>
