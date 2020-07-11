@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Upload User Excel</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">User Login Details</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Upload Excel</h4>
                            <p class="card-title-desc">Kindly, upload an excel file containing the system users' details
                            </p>
                            <div>
                                <form action="{{route('user.upload-user-excel-file')}}"  method="post" enctype="multipart/form-data">
                                    @csrf
                                   {{-- <div class="fallback">
                                        <input name="user" type="file" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" >
                                    </div>--}}
                                    <div class="custom-file-container"
                                         data-upload-id="upload-user-excel">
                                        <label for="payment_proof_sell" class="text-sm"
                                               style="font-family: OpenSans, sans-serif; color: #373e45; font-size: 18px; margin-top: 20px"
                                        >
                                            Upload payment proof
                                            <a
                                                href="javascript:void(0)"
                                                class="custom-file-container__image-clear"
                                                id="close_image_preview-bitcoin-sell"
                                                title="Clear Image"
                                                style="color: red"
                                            >
                                                x
                                            </a>
                                        </label>
                                        <label
                                            class="custom-file-container__custom-file"
                                            style="margin-bottom: 15px;"
                                        >
                                            <input type="file" name="user"
                                                   class="custom-file-container__custom-file__custom-file-input"
                                                   id="payment_proof-bitcoin-sell" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                   required>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                                            <span
                                                class="custom-file-container__custom-file__custom-file-control"
                                                style="font-family: Quicksand, sans-serif;"></span>
                                        </label>
                                        <div
                                            class="custom-file-container__image-preview"
                                            id="image-preview-placeholder-bitcoin-sell"></div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Upload Excel File</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>

@endsection
@section('script_contents')
    <script>
        var firstUpload = new FileUploadWithPreview('upload-user-excel')
    </script>
@endsection
