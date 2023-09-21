@php
    $sliderSectionOne = json_decode($sliderSectionOne->value);

@endphp
<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.product-slider-section-one') }}" method="post">
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
                                    <option {{ $sliderSectionOne->category == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories = \App\Models\Subcategory::where('category_id', $sliderSectionOne->category)->get();

                            @endphp
                            <label for="">Alt Kategori</label>
                            <select name="sub_cat_one" class="form-control sub-category">
                                <option value="">Seçiniz</option>
                                @foreach ($subCategories as $subCategory)
                                    <option {{ $subCategory->id == $sliderSectionOne->sub_category ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dış Kategori</label>
                            @php
                                $childCategories = \App\Models\ChildCategory::where('sub_category_id',  $sliderSectionOne->sub_category )->get();
                            @endphp
                            <select name="child_cat_one" class="form-control child-category">
                                <option value="">Seçiniz</option>
                                @foreach ($childCategories as $childCategory)
                                <option
                                    {{ $childCategory->id == $sliderSectionOne->sub_category ? 'selected' : '' }}
                                    value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 1 --}}

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
                        selector.append('<option value="" >Seçiniz</option>');
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
                        selector.html('<option value=""> Seçiniz</option>');
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
