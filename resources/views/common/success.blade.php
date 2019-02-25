@if(session()->has("success"))
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-success" style="margin-bottom: 0; ">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{ session()->get("success") }}
      </div>
    </div>
  </div>
</div>
@endif