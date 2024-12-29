@extends('layouts.dashboard',['title'=>'Add Products'])
@section('dashboard')
<div class="container mt-3">
    <h1 class="text-center">Add Product</h1>
    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-2">
            <div class="col-md-4 h-100">
                <!-- <label for="">Cover Photo</label> -->
                <div class="m-3 card p-3 border-dark bg-transparent" style="border-style:dashed;">
                    <img id="out" src="" style="width: 100%; object-fit:scale-down;" />
                    <input type="file" accept="image/*" name="cover" id="cover" style="display: none;" class="form-control" onchange="loadCoverFile(event)">
                    <div class="pt-2" id="desc">
                        <div class="" id="uploader">
                            <div class="text-center" style="font-size: xxx-large; font-weight:bolder;">
                                <i class="bi bi-upload"></i>
                            </div>
                            <div class="text-center text-primary">*Supported files .png .jpg .webp</div>
                        </div>
                        <div class="text-center">
                            <label for="cover" class="btn btn-success text-white"
                                title="Upload new profile image">Browse</label>
                        </div>
                    </div>
                    <script>
                        var loadCoverFile = function(event) {
                            var image = document.getElementById('out');
                            image.src = URL.createObjectURL(event.target.files[0]);
                            document.getElementById('cover').value == image.src;
                            document.getElementById('uploader').style.display = 'none';
                        };
                    </script>
                </div>
            </div>
            <div class="col-md-8">
                <div class="mb-2">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-2">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-2">
                    <label for="price">Unit of Measure</label>
                    <select name="units" class="form-select" id="">
                        <option value="Kg">Kg</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Ltr">Ltr</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="stock">Category</label>
                    <select name="category" class="form-select" id="">
                        <option value="Cereals">Cereals</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Poutry">Poutry</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-2">
            <label for="description">Description</label>
            <textarea class="form-control" id="editor" name="description" rows="3" ></textarea>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
    </form>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/super-build/ckeditor.js"></script>
<script>
    CKEDITOR.ClassicEditor
        .create(document.getElementById("editor"), {

            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },

            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType'
            ]
        }).then(editor => {
            editor.editing.view.change(writer => {
                writer.setStyle('min-height', '60vh', editor.editing.view.document.getRoot());
            });
        });
</script>
@endsection