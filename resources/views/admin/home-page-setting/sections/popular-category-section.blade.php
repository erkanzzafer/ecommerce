@php
    $popularCategoriesSection = json_decode($popularCategoriesSection->value);

@endphp
<div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.popular-category-section') }}" method="post">
                @csrf
                @method('put')
                <h5>Kategori 1</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="cat_one" class="form-control main-category" value="">
                                <option value="">Seçiniz</option>
                                @foreach ($categories as $category)
                                    <option
                                        {{ $category->id == $popularCategoriesSection[0]->category ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories = \App\Models\Subcategory::where('category_id', $popularCategoriesSection[0]->category)->get();
                            @endphp
                            <label for="">Alt Kategori</label>
                            <select name="sub_cat_one" class="form-control sub-category"  value="">
                                <option value="">Seçiniz</option>
                                @foreach ($subCategories as $subCategory)
                                    <option
                                        {{ $subCategory->id == $popularCategoriesSection[0]->sub_category ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories = \App\Models\ChildCategory::where('sub_category_id', $popularCategoriesSection[0]->sub_category)->get();
                            @endphp
                            <label for="">Dış Kategori</label>
                            <select name="child_cat_one" class="form-control child-category"
                                value="">
                                <option value="">Seçiniz</option>
                                @foreach ($childCategories as $childCategory)
                                    <option
                                        {{ $childCategory->id == $popularCategoriesSection[0]->child_category ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 1 --}}

                <h5>Kategori 2</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="cat_two" class="form-control main-category" value="">
                                <option value="">Seçiniz</option>
                                @foreach ($categories as $category)
                                    <option
                                        {{ $category->id == $popularCategoriesSection[1]->category ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Alt Kategori</label>
                            @php
                                $subCategories = \App\Models\Subcategory::where('category_id', $popularCategoriesSection[1]->category)->get();
                            @endphp
                            <select name="sub_cat_two" class="form-control sub-category"  value="">
                                <option value="">Seçiniz</option>
                                @foreach ($subCategories as $subCategory)
                                    <option
                                        {{ $subCategory->id == $popularCategoriesSection[1]->sub_category ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories = \App\Models\ChildCategory::where('sub_category_id', $popularCategoriesSection[1]->sub_category)->get();
                            @endphp
                            <label for="">Dış Kategori</label>
                            <select name="child_cat_two" class="form-control child-category"
                                value="">
                                <option value="">Seçiniz</option>
                                @foreach ($childCategories as $childCategory)
                                    <option
                                        {{ $childCategory->id == $popularCategoriesSection[1]->child_category ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 2 --}}


                <h5>Kategori 3</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kategori</label>
                            @php
                                $subCategories = \App\Models\Subcategory::where('category_id', $popularCategoriesSection[2]->category)->get();
                            @endphp
                            <select name="cat_three" class="form-control main-category" value="">
                                <option value="">Seçiniz</option>
                                @foreach ($categories as $category)
                                    <option
                                        {{ $category->id == $popularCategoriesSection[2]->category ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Alt Kategori</label>
                            <select name="sub_cat_three" class="form-control sub-category"
                                value="">
                                <option >Seçiniz</option>
                                @foreach ($subCategories as $subCategory)
                                    <option
                                        {{ $subCategory->id == $popularCategoriesSection[2]->sub_category ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories = \App\Models\ChildCategory::where('sub_category_id', $popularCategoriesSection[2]->sub_category)->get();
                            @endphp
                            <label for="">Dış Kategori</label>
                            <select name="child_cat_three" class="form-control child-category"
                                value="">
                                <option value="">Seçiniz</option>
                                @foreach ($childCategories as $childCategory)
                                    <option
                                        {{ $childCategory->id == $popularCategoriesSection[2]->child_category ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 3 --}}

                <h5>Kategori 4</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kategori</label>
                            @php
                                $subCategories = \App\Models\Subcategory::where('category_id', $popularCategoriesSection[3]->category)->get();
                            @endphp
                            <select name="cat_four" class="form-control main-category"  value="">
                                <option >Seçiniz</option>
                                @foreach ($categories as $category)
                                    <option
                                        {{ $category->id == $popularCategoriesSection[3]->category ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Alt Kategori</label>
                            <select name="sub_cat_four" class="form-control sub-category"
                                value="">
                                <option value="">Seçiniz</option>
                                @foreach ($subCategories as $subCategory)
                                    <option
                                        {{ $subCategory->id == $popularCategoriesSection[3]->sub_category ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories = \App\Models\ChildCategory::where('sub_category_id', $popularCategoriesSection[3]->sub_category)->get();
                            @endphp
                            <label for="">Dış Kategori</label>
                            <select name="child_cat_four" class="form-control child-category"
                                value="">
                                <option value="">Seçiniz</option>
                                @foreach ($childCategories as $childCategory)
                                    <option
                                        {{ $childCategory->id == $popularCategoriesSection[3]->child_category ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 4 --}}


                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                let row = $(this).closest('.row');
                $.ajax({
                    method: 'get',
                    url: "{{ route('admin.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find('.sub-category')
                        selector.empty();
                        selector.append('<option >Seçiniz</option>');
                        $.each(data, function(i, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                    }
                })
            })




            //get child category
            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();
                let row = $(this).closest('.row')
                $.ajax({
                    method: 'get',
                    url: "{{ route('admin.get-childcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find('.child-category')
                        console.log(data);
                        //  selector.empty();
                        // selector.append('<option >Seçiniz</option>');
                        selector.html('<option> Seçiniz</option>');
                        $.each(data, function(i, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                    }
                })
            })
        });
    </script>
@endpush
