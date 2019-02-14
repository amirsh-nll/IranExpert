		<div class="content" style="min-height:1000px;">
			<h2>جستجو کاربران:</h2>
			<?php
				echo '<div class="searchboxs">';
				echo form_open($url . 'search', 'method="get" class="search_form"');
				$search_input = array(
					'name'			=>	'key',
					'placeholder'	=>	'جستجوی کاربران + اینتر',
					'maxlength'		=>	'100'
				);
				echo form_input($search_input);
				echo form_close();
				echo '</div>';

				if($user===0)
				{
					echo '<p style="margin:0px;background:#000;color:#fff;padding:10px;">* کاربری یافت نشد. *</p>';
				}
				else
				{
					?>
					<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
						<tr>
							<td style="text-align:center;">ردیف</td>
							<td style="text-align:center;">نام کامل کاربر</td>
							<td style="text-align:center;">نام کاربری</td>
							<td></td>
						</tr>
						<?php $i=1; foreach ($user as $my_user): if($my_user['middle_name']=='admin'){continue;} if($my_user['full_name']==' '){$my_user['full_name']='ناشناس';} ?>
							<tr style="font-size:19px;">
								<td style="width:10%; padding:10px; text-align:center;"><?php echo $this->jdf->tr_num($i); ?></td>
								<td style="width:40%; padding:10px; text-align:center;"><?php echo $my_user['full_name']; ?></td>
								<td style="width:40%; padding:10px; text-align:center;"><?php echo $my_user['middle_name']; ?></td>
								<td style="width:10%; padding:10px; text-align:center;"><a href="<?php echo $url . 'profile/' . $my_user['middle_name']; ?>" target="_blank" class="retrive_data_table_globe" title="مشاهده رزومه <?php echo $my_user['full_name']; ?>"><span class="fa fa-lg fa-globe"></span></a></td>
							</tr>
						<?php $i+=1; if($i>30){break;} endforeach;?>
					</table>
					<?php
				}
			?>
		</div>