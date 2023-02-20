<form action="{{ route('searchResults', App::getLocale()) }}" method="GET">
    @csrf

    <div class="input-group">
        <div class="form-outline">
          <input type="text" id="query" name="query" value="{{ request()->input('query') }}" placeholder="{{__('Search for products...')}}" class="form-control" />
        </div>

        <button type="submit" name="submit" class="btn btn-secondary">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>