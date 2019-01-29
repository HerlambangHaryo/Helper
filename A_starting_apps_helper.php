<?php
	
	use App\data_002914;

	function starting_app($PARAM_1,$PARAM_2){
		// ------------------------------------------------------------------------- COPY TO MAIN

		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			if($PARAM_1 == 'by_dmha_id')
			{
				if($PARAM_2 == '00')
				{
					$status_id		= '1';
					$dmha_id 		= '00';
					$parent_id 		= NULL;
					$urutan 		= '0';
					$nama 			= 'System';
					$link 			= 'javascript:;';
					$deskripsi 		= NULL;
					$has_sub 		= 'has-sub';
					$bg_color 		= '38';
					$icon 			= '8';
					$css 			= NULL;
					$content 		= NULL;
					$js 			= NULL;
					$script_js 		= NULL;
					$tipe_data 		= NULL;
					$form 			= NULL;
					$kategori 		= '3';
					$helper1 		= NULL;
				}
				elseif($PARAM_2 == '21')
				{
					// Login
					$status_id		= '3';
					$dmha_id 		= '21';
					$parent_id 		= NULL;
					$urutan 		= '1';
					$nama 			= 'Login';
					$link 			= 'login';
					$deskripsi 		= NULL;
					$has_sub 		= 'has-sub';
					$bg_color 		= '38';
					$icon 			= '8';
					$css 			= NULL;
					$content 		= NULL;
					$js 			= NULL;
					$script_js 		= NULL;
					$tipe_data 		= NULL;
					$form 			= NULL;
					$kategori 		= '3';
					$helper1 		= NULL;
				}
			}
			elseif($PARAM_1 == 'by_package')
			{
				if($PARAM_2 == 'subdmha_id')
				{

				}
			}

			data_002914::insert(
				[
					'status_id'  	=> $status_id,
					'dmha_id'  		=> $dmha_id,
					'parent_id'  	=> $parent_id,
					'urutan'  		=> $urutan,
					'nama'  		=> $nama,
					'link'  		=> $link,
					'deskripsi'  	=> $deskripsi,
					'has_sub'  		=> $has_sub,
					'bg_color'  	=> $bg_color,
					'icon'  		=> $icon,
					'css'  			=> $css,
					'content'  		=> $content,
					'js'  			=> $js,
					'script_js'  	=> $script_js,
					'tipe_data'  	=> $tipe_data,
					'form'  		=> $form,
					'kategori'  	=> $kategori,
					'helper1'  		=> $helper1,
				]
			);
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}
