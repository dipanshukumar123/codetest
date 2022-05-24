<div class="input-group" id="tbl_actions">
    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
        Actions
    </button>
    <div class="dropdown-menu">
        <form class="px-3 py-2">
            <div class="form-group">
                <div class="icheck-primary">
                    <input type="radio" id="filterSortDesc" name="sort" value="desc" @if(request()->query('sort') == 'desc') checked @else checked @endif>
                    <label for="filterSortDesc" class="font-weight-normal text-sm">Sort By: DESC</label>
                </div>
            </div>
            <div class="form-group">
                <div class="icheck-primary">
                    <input type="radio" id="filterSortAsc" name="sort" value="asc" @if(request()->query('sort') == 'asc') checked @endif>
                    <label for="filterSortAsc" class="font-weight-normal text-sm">Sort By: ASC</label>
                </div>
            </div>

            <div class="dropdown-divider"></div>

            <div class="form-group mt-3">
                <div class="icheck-primary">
                    <input type="radio" id="filterStatusActive" name="status" value="1" @if(request()->query('status') == '1') checked @else checked @endif>
                    <label for="filterStatusActive" class="font-weight-normal text-sm">Status: Active</label>
                </div>
            </div>
            <div class="form-group">
                <div class="icheck-primary">
                    <input type="radio" id="filterStatusInactive" name="status" value="0" @if(request()->query('status') == '0') checked @endif>
                    <label for="filterStatusInactive" class="font-weight-normal text-sm">Status: Inactive</label>
                </div>
            </div>

            <div class="dropdown-divider"></div>

            <div class="form-group mt-3">
                <div class="icheck-primary">
                    <input type="checkbox" id="filteronlyTrashed" name="onlyTrashed" value="1" @if(request()->query('onlyTrashed') == '1') checked @endif>
                    <label for="filteronlyTrashed" class="font-weight-normal text-sm">Only Trashed</label>
                </div>
            </div>

            <button type="submit" class="btn btn-sm btn-block btn-primary mt-4">Apply</button>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tbl_actions').on('hide.bs.dropdown', function (e) {
                if (e.clickEvent) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush

