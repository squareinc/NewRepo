<?php
use yii\helpers\Html;
use yii\base\view;
?>
<style>
.fixed-container-body-class {
    padding-top: 0;
}
	.image-edit {
  box-shadow: 0 2px 15px 0 rgba(78, 68, 137, 0.3);
  height: auto;
  margin-bottom: 20px;
  margin-top: 20px;
  padding: 15px;
  width: 100%;
}
</style>
<div class="page-content jet-install">
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="content-section">
					<div class="form new-section">
						<h3 id="sec3"> Jet Attribute Mapping</h3>
						<br>
				        <p>
				            Choose jet attributes that you want to map with your product variant options with. 
				        </p>
				        <br>
				       	<p>Take Engagement Ring as a shopify product type for example: </p>
	     				<p>Now, in order to transfer correct information of your products on jet, you need to map jet attributes with your product variant options (attributes) . Like, map <b>"Size-Free Text" attribute of jet</b> with <b>"Size" variant option of your engagement ring (product type)</b> and <b>jet's "Color"</b> with <b>engagement ring's "Color"</b>.</p>
				        <img class="image-edit" src="<?= Yii::$app->request->baseUrl; ?>/images/guide/jet-attribute-mapping.png" alt="jet-attribute-mapping"/>
				        
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
