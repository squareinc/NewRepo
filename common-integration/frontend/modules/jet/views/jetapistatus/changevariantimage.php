<?php 

use yii\helpers\Html;
$updateurlimage='';
$updateurlimage= yii\helpers\Url::toRoute(['jetproduct/savevariantimage']);

/* echo "<pre>";
print_r($collection);
die; */
?>
<link rel="stylesheet" href="<?= Yii::$app->getUrlManager()->getBaseUrl();?>/css/bootstrap_file_field.css">
<div class="container">
  <!-- Modal -->
  <div class="modal fade rounded" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content modal-content-error">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;font-family: "Comic Sans MS";">Update Variant Products Images</h4>
        </div>
        <div class="modal-body">
			<div class="image_popup">
				<div class="fieldset enable_api">
					<table class="table table-striped table-bordered">
						<th width="20%">
							<center>Product SKU</center>
						</th>
						<th width="80%">
							<center>Update Image</center>
						</th>
						<?php
						$html=''; 
						foreach ($collection as $key => $value) 
						{
							//$additional=[];
	                  		//$additional=json_decode($value['image'],true);
	                  		$html.='<tr><td>';	                  		
                  			if(count(explode(',',$value['option_image']))>0)
                  			{
                  				$images=[];
                  				$images=explode(',',$value['option_image']);
                  				if(strpos($images[0],'upload/images')!== false) {
                  					$html.= Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/'.$images[0],
                  							['width' => '80px','height'=>'80px']);
                  				}else{
                  					$html.= Html::img($images[0],
                  							['width' => '80px','height'=>'80px']);
                  				}
                  			}else{
                  				$html.= Html::img($value['option_image'],
                  						['width' => '80px','height'=>'80px']);
                  			}
	    			        $html.='<br>'.$value['option_sku'].'</td>
	    			        <td>
	    			        	<form enctype="multipart/form-data" action="#" method="post" class="form-image" id="form-data-'.$value['option_id'].'">
									<div class="form-group" id="image_contrainer_'.$value['option_id'].'">
										<input type="file" name="files[]" data-field-type="bootstrap-file-filed" data-label="Select Images" data-btn-class="btn-primary" data-file-types="image/jpeg,image/png" data-preview="on" multiple>
										<input type="button" class="btn btn-primary" onclick=updateImage(this,"'.$value['option_id'].'") value="save & upload"/>
										<img scr="'.Yii::$app->getUrlManager()->getBaseUrl().'/images/712.gif" style="display:none">
										<input type="hidden" name="id" value="'.$value['option_id'].'">
									</div>
								</form>
							</td></tr>';
						}
						echo $html;
						?>
					</table>
				</div>
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>	      
    </div>
  </div>	  
</div>	
<script type="text/javascript">
var csrfToken = $('meta[name="csrf-token"]').attr("content");
function deleteImg(node){
    $(node).parent('li').remove();
}
/*! BootstrapFileField v1.2.0 | (c) ajaxray.com | MIT License
 * https://github.com/ajaxray/bootstrap-file-field
 **/
(function( $ ) {

    $.fn.bootstrapFileField = function(options) {

        var settings = $.extend({
            // Presentation
            label: "Select File",
            btnClass: 'btn-default',
            preview: 'off',

            // Restrictions
            fileTypes: false,
            maxFileSize: false,
            minFileSize: false,
            maxTotalSize: false,
            maxNumFiles: false,
            minNumFiles: false
        }, options );

        var abort = function(input) {
            input.files.value = "";
            return false;
        };

        var withPreviewThumb = function(file, callback) {

                var reader = new FileReader();

                reader.addEventListener("load", function () {
                    var image = new Image();
                    image.title = file.name;

                    if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
                        image.src = this.result;
                    } else {
                        image.className += 'icon';
                        image.src = 'data:image/png;base64,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';
                    }
                    callback(image,file);
                }, false);

                reader.readAsDataURL(file);
        };

        var fileSelectHandler = function(event, files, fileNameList) {
            fileNameList.empty();
            var preview = fileNameList.hasClass('thumbs');
            var count=0;
            for (var i in files) {

                if (files.hasOwnProperty(i) && $.isNumeric(i)) {
                    var name = files[i].name;
                   
                    if(preview) {
                        withPreviewThumb(files[i], function (image,file) {
                            count++;
                            $(image).addClass('img-rounded');
                            $('<li></li>')
                                .append(image)
                                .append('<a href="javascript:void(0)" class="file-name" id="image-'+count+'" onclick="deleteImg(this);"><span class="glyphicon glyphicon-trash"></span></a>')
                                .append('<input class="input-name form-control image-value" style="width:20%;text-align:center;margin-left:25px;margin-top:5px" name="image['+file.name+']" id="image-position-'+count+'" value='+count+'>')
                                .appendTo(fileNameList);
                        });
                    } else {
                        fileNameList.append('<li class="text-success">&check; ' + name + '</li>');
                    }
                }
            }
        };

        var fileSelectionErrorHandler = function(event, message, fileNameList) {
            fileNameList.empty()
                .append('<li class="text-danger"><b>Error!</b> '+ message +'</li>');
        };

        this.filter( ":file" ).each(function() {
            var btnClass     = $(this).data('btn-class') || settings.btnClass;
            var label        = $(this).data('label') || settings.label;
            var preview      = $(this).data('preview') || settings.preview;

            if (label == settings.label && $(this).attr('multiple')) {
                label += 's';
            }

            // Restrictions
            var fileTypes    = $(this).data('file-types') || settings.fileTypes;
            var maxFileSize  = $(this).data('max-file-size') || settings.maxFileSize;
            var minFileSize  = $(this).data('min-file-size') || settings.minFileSize;
            var maxTotalSize = $(this).data('max-total-size') || settings.maxTotalSize;
            var maxNumFiles  = $(this).data('max-num-files') || settings.maxNumFiles;
            var minNumFiles  = $(this).data('min-num-files') || settings.minNumFiles;

            var button = $('<span class="btn btn-file"></span>')
                .addClass(btnClass)
                .insertBefore(this);
            var fileList = $('<ul class="list-unstyled small fileList"></ul>')
                .insertAfter(button);
            if('on' == preview) {
                fileList.addClass('thumbs');
            }

            $(button).append(label);
            $(button).append(this);

            $(this).on('fileSelect', fileSelectHandler);
            $(this).on('fileSelectionError', fileSelectionErrorHandler);

            $(this).on('change', function(e) {
                //console.log(this.files);

                // Check max file number
                if(maxNumFiles && this.files.length > maxNumFiles) {
                    $(this).trigger('fileSelectionError', [maxNumFiles +' files are allowed at most!', fileList]);
                    return abort(this);
                }

                // Check min file number
                if(minNumFiles && this.files.length < minNumFiles) {
                    $(this).trigger('fileSelectionError', ['Have to select at least '+ minNumFiles +' files!', fileList]);
                    return abort(this);
                }

                // Check max total size
                if(maxTotalSize) {
                    var totalSize = 0;
                    for (var x = 0; x < this.files.length; x++) {
                        totalSize += this.files[x].size;
                    }
                    if(totalSize > maxTotalSize) {
                        $(this).trigger('fileSelectionError', ['Total size of selected files should not exceed '+ maxTotalSize +' byte!', fileList]);
                        return abort(this);
                    }
                }

                // Check file-wise restrictions
                for (var x = 0; x < this.files.length; x++) {

                    var file = this.files[x];

                    // Check file type
                    if(fileTypes && fileTypes.indexOf(file.type) < 0) {
                        $(this).trigger('fileSelectionError', [file.name +' : File type is not allowed!', fileList]);
                        return abort(this);
                    }

                    // Check max size
                    if(maxFileSize && file.size > maxFileSize) {
                        $(this).trigger('fileSelectionError', [file.name +' : Exceeding maximum allowed file size!', fileList]);
                        return abort(this);
                    }

                    // Check min size
                    if(minFileSize && file.size < minFileSize) {
                        $(this).trigger('fileSelectionError', [file.name +' : Smaller than minimum allowed file size!', fileList]);
                        return abort(this);
                    }

                }

                $(this).trigger('fileSelect', [this.files, fileList]);
            });

        });

        return this;

    };

    $(':file[data-field-type="bootstrap-file-filed"]').bootstrapFileField({});

}( $ ));

$('.smart-file').bootstrapFileField({
    maxNumFiles: 20,
    fileTypes: 'image/jpeg,image/png',
    maxFileSize: 800000 // 80kb in bytes
});

//send images for save
function updateImage(node,id){
	if($('#image_contrainer_'+id).has('li').length > 0){
		var url='<?= $updateurlimage ?>';
		var formData = new FormData($('#form-data-'+id)[0]);
		$('#LoadingMSG').show();
		//console.log(formData);
	    $.ajax({
	      url: url,
	      cache: false,
	      contentType: false,
    	  processData: false,
    	  type: 'POST',
	      data: formData,
	    })
	    .done(function(msg) {
			//console.log(msg);
	       $('#LoadingMSG').hide();
	       alert(msg);
	    });
	}
}
</script>