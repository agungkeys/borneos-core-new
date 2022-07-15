@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-credit icon-gradient bg-tempting-azure"></i>
            </div>
            <div>
               Add Master Payment
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-6">
         <div class="main-card mb-3 card">
            <div class="card-body">
               <form action="{{ route('admin.master-payment.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                  @csrf
                  <div class="form-group">
                     <label for="payment_name">Payment Name</label>
                     <input type="text" id="payment_name" name="payment_name" class="form-control" placeholder="Payment Name">
                     @error('payment_name')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="payment_type">Payment Type</label>
                     <select name="payment_type" id="payment_type" class="js-data-example-ajax multiselect-dropdown form-control">
                        <option disabled selected value="">Choose One!</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="digital">Digital</option>
                    </select>
                     @error('payment_type')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                    <label for="account_name">Account Name</label>
                    <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Account Name">
                    @error('account_name')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="account_no">Account No</label>
                    <input type="number" name="account_no" id="account_no" class="form-control" placeholder="Account No">
                    @error('account_no')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                     <label for="image">Image</label><br>
                     <input type="file" accept="image/*" id="image" name="image">
                     @error('image')
                        <br><span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group text-center" style="margin-bottom:0%;">
                     <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" alt=""/>
                  </div>
                  <div class="text-right mt-2">
                     <a href="{{ route('admin.master-payment') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                     <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection
@section('js')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function () {
            readURL(this);
        });
    </script>
@endsection
