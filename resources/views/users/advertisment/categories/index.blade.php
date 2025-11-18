<div class="adverts-options beehive-filters">
    <form action="{{ route('categories.store') }}" method="{{ FORM_METHOD_POST }}">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Title: </label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" required />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Select Status: </label>
                    <select name="status" id="slctStatus" class="form-control">
                        <option value="">Select</option>
                        <option value="{{ CATEGORY_STATUS_ACTIVE }}">Active</option>
                        <option value="{{ CATEGORY_STATUS_INACTIVE }}">Inactive</option>
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
    <table class="table table-hover table-striped table-borderless">
        <thead>
            <tr>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $key => $value)
                <tr>
                    <td>{{ $value->category_title }}</td>
                    <td>
                        @switch($value->status)
                            @case(CATEGORY_STATUS_ACTIVE)
                                <span class='badge badge-success'>Active</span>
                            @break

                            @case(CATEGORY_STATUS_INACTIVE)
                                <span class="badge badge-danger">Inactive</span>
                            @break

                            @default
                                <span class="badge badge-warning">Invalid Status</span>
                            @break
                        @endswitch
                    </td>
                    <td>
                        <button id="{{ $value->category_id }}" onclick="EditCategory(this)" data-toggle="modal" data-target="#modalEditCategory" class="btn rounded-circle border-info btn-md border-0 text-white"><i
                                class="uil-pen"></i></button>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="3">{{ __('No Categories Found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
