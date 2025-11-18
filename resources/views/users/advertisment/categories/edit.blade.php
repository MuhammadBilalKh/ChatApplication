<div class="adverts-options beehive-filters">
    <form action="{{ route('categories.update', ['id' => $category->category_id]) }}" method="{{ FORM_METHOD_POST }}">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Title: </label>
                    <input type="text" name="title" value="{{ $category->category_title }}" class="form-control" required />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Select Status: </label>
                    <select name="status" id="slctStatus" class="form-control">
                        <option value="">Select</option>
                        <option @if($category->status == CATEGORY_STATUS_ACTIVE) selected @endif value="{{ CATEGORY_STATUS_ACTIVE }}">Active</option>
                        <option @if($category->status == CATEGORY_STATUS_INACTIVE) selected @endif value="{{ CATEGORY_STATUS_INACTIVE }}">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mt-3">
                    <input type="submit" value="Submit" class="btn btn-success" />
                </div>
            </div>
        </div>
    </form>
</div>
