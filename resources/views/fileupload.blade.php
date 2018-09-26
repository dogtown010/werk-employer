<form class="fileupload" action="{{url('processImport')}}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="file">Select a file to upload</label>
               <input type="file" name="file" id="file" class="form-group">
         </div>
      </div>
      <div class="col-xs-12">
          <button type="submit" class="btn btn-primary">Upload</button>
     </div>
   </div>
 </form>


