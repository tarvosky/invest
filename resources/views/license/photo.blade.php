@extends('layouts.app_home')

@section('content')
<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="widget p-md clearfix">
					<div>
						<h3 class="widget-title">Picture Instruction</h3>
            <ul>
              <li >Select any of the picture below and it will automatically save</li>
              <li >If you want to upload your own image scroll to the bottom of the page</li>
          </ul>
					</div>
				</div><!-- .widget -->
			</div>

		
		</div><!-- .row -->




    <div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="widget p-md clearfix">
					<div >
            <div class="text-center">
              <img  width="120px" height="120px" style="margin-bottom:5px"id="myImg" src="{{ asset('license/photo/sample.jpg')}}" class="pb-2" alt="...">
              <div id="loading" style="display:none;margin-top:5px" class="m-2"> <img  width="50px" height="50px" src="{{ asset('loading.gif')}}" /></div>
              
              <div id="saved" style="display:none;margin-top:5px" class="alert alert-success mt-3"> Image saved!!!</div>
            </div>
					</div>
				</div><!-- .widget -->
			</div>

			<div class="col-md-6 col-sm-6">
				<div class="widget p-md clearfix">
					<div class="">
            <h5 class="widget-title">When you are done you can navigate by clicking on the "finish button"</h5>
            <br><br>
            <div class="text-center mt-5 mt-5">
              <a class="btn btn-danger btn-lg" href="{{ asset('license/index')}}"> Finish >> </a>
          </div>
					</div>
				
				</div><!-- .widget -->
			</div>
		</div><!-- .row -->



	
		<div class="row">
			<div class="col-md-12">
				<div class="widget widget-pie-chart">
					<header class="widget-header">
						<h4 class="widget-title">uploaded (This is only visible to you for privacy reasons)</h4>
          </header>
          <div class="widget-body">
          @foreach ($myimages as $item)
          <?php 
          $id = $item->id;
          $image = $item->image;
          ?>
          <div class="avatar avatar-xl">
            <img onClick='reply_click("<?php echo $id ?>","<?php echo $image ?>")'  src="{{ asset('license/photo/thumb/'.$item->image)}}" alt="">
          </div>
              @endforeach
            </div>
          </div>
          </div><!-- .widget -->
        </div>


      <div class="row">
        <div class="col-md-12">
          <div class="widget ">
            <header class="widget-header">
              <h4 class="widget-title">Young Ages</h4>
            </header>
            <div class="widget-body">
            @foreach ($young as $item)
            <?php 
            $id = $item->id;
            $image = $item->image;
            ?>
            <div class="avatar avatar-xl">
							<img onClick='reply_click("<?php echo $id ?>","<?php echo $image ?>")'  src="{{ asset('license/photo/thumb/'.$item->image)}}" alt="">
            </div>
            @endforeach
            <div class="mt-1"> {{ $young->links() }}</div>
          </div>
          </div>
          </div><!-- .widget -->
        </div>



        <div class="row">
          <div class="col-md-12">
            <div class="widget widget-pie-chart">
              <header class="widget-header">
                <h4 class="widget-title">Matured Ages</h4>
              </header>
              <div class="widget-body">
              @foreach ($midAge as $item)
              <?php 
              $id = $item->id;
              $image = $item->image;
              ?>
              <div class="avatar avatar-xl">
                <img onClick='reply_click("<?php echo $id ?>","<?php echo $image ?>")'  src="{{ asset('license/photo/thumb/'.$item->image)}}" alt="">
              </div>
              @endforeach
              <div class="mt-1"> {{ $midAge->links() }}</div>
            </div>
          </div>
          </div><!-- .widget -->
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="widget widget-pie-chart">
              <header class="widget-header">
                  <div class="widget-body">
                  <h4 class="widget-title">Old Ages</h4>
                </header>
                <div class="widget-body">
                @foreach ($old as $item)
                <?php 
                $id = $item->id;
                $image = $item->image;
                ?>
                <div class="avatar avatar-xl">
                  <img onClick='reply_click("<?php echo $id ?>","<?php echo $image ?>")'  src="{{ asset('license/photo/thumb/'.$item->image)}}" alt="">
                </div>
                @endforeach
                <div class="mt-1"> {{ $old->links() }}</div>
              </div>
            </div>
            </div><!-- .widget -->
          </div>





          <div class="row">
            <div class="col-md-12">
              <div class="widget widget-pie-chart">
                <header class="widget-header">
                  <div class="widget-body">
                  <h4 class="widget-title">Upload your photo</h4>
                </header>
                <div class="widget-body">
                  <p>To get the best experience make sure to review the following</p>
                  <ul>
                      <li>Make sure  the photo you want to upload is 250px by 250px</li>
                      <li>The image must not be more than 2mb</li>
                      <li>After you click on the "upload button" below, you will find the picture you just uploaded among the pictures above</li>
                     <li class="text-danger"> Make sure the picture has a transparent background very important!</li>
                     <li class="text-danger"> Make sure there is space between the chin and chest very important!</li>
                  </ul>


                  <form method="POST" enctype="multipart/form-data" action="{{ url('license/upload-photo') }}" >
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="file" name="image" placeholder="Choose image" id="image">
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif
      
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                          
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>     
                </form>
      




              </div>
            </div>
            </div><!-- .widget -->
          </div>








		</div><!-- .row -->
    @endsection

@push('scripts')

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<script type="text/javascript">
   

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function() {
         $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "{{ asset('license/get-selected-photo/'. $license->id )}}",       
          success: function (data) {
            var theUrl = "{{ asset('license/photo') }}";
           // $("#myimage").html(data.success);
           // console.log(theUrl+data.success);
            document.getElementById("myImg").src = theUrl+"/"+data.success;
          },
            error: function (data) {
            var errors = $.parseJSON(data.responseText);
            console.log(errors);
            }
        });
      });

  function reply_click(id,image)
  {
     // alert(id+'--'+image);
     
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     document.getElementById("loading").style.display = "block";
     $.ajax({
            url:"{{ asset('license/update-selected-photo/'. $license->id )}}",
            type: 'post',
             data: {_token: CSRF_TOKEN,image:image},
            dataType:'json',
           success: function (data) {
           console.log(data);
           console.log(image);
           var theUrl = "{{ asset('license/photo/thumb') }}";
           document.getElementById("myImg").src = theUrl+"/"+image;
           document.getElementById("loading").style.display = "none";
           document.getElementById("saved").style.display = "block";
            },
            error: function (data) {
            var errors = $.parseJSON(data.responseText);
            console.log(errors);
            }
        })


  }
</script>
@endpush
