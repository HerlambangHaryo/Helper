<?php
	
	use App\ktps;
	use App\wilayah_kotas;
	use App\wilayah_kecamatans;
	use App\wilayah_kelurahans;
	use App\font_awesome;
	use App\bg_colors;
	use App\data_002914;
	use App\data_details_02;
	use App\data_02;
	use App\app_mode;
	use App\pengaturan_02;
	use App\sumber_data_pengisians;

	function read_my_ktps($id)
	{
		$isi = ktps::where('id',$id)->value('nama');
			
		$words = $isi;
		return $words;
	}

	function whats_my_age($birthDate)
	{
		// Birthdate format dd-mm-yyyy

		if($birthDate != '')
		{
		  	$birthDate = explode("-", $birthDate);

		  	$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
		    ? ((date("Y") - $birthDate[2]) - 1)
		    : (date("Y") - $birthDate[2]));

	  		$words =  $age;	
	  	}
	  	else
	  	{
	  		$words = '';
	  	}

	  	return $words;
	}

	function whats_my_keterangan_wilayah($wilayah_id)
	{
		// 	3515 120 004
		// 	3515 120
		// 	3515

		if(strlen($wilayah_id) == 10)
		{
	  		$words =  wilayah_kelurahans::where('id','like', $wilayah_id)->value('keterangan');
	  	}
	  	elseif(strlen($wilayah_id) == 7)
	  	{
	  		$words = wilayah_kecamatans::where('id','like', $wilayah_id)->value('keterangan');
	  	}
	  	elseif(strlen($wilayah_id) == 4)
	  	{
	  		$words = wilayah_kotas::where('id','like', $wilayah_id)->value('keterangan');
	  	}

	  	return $words;
	}

	function whats_your_font_awesomes_name($id)
	{
		return $words = font_awesome::where('id','like',$id)->value('nama');
	}

	function whats_your_bg_colors_name($id)
	{
		return $words = bg_colors::where('id','like',$id)->value('nama');
	}

	function give_me_quick_dmha($id,$coloumn_name)
	{
		return $words = data_002914::where('dmha_id','like',$id)->value($coloumn_name);
	}

	function whats_my_nama_wilayah($wilayah_id)
	{
		// 	3515 120 004
		// 	3515 120
		// 	3515
		$isi = '';

		if(strlen($wilayah_id) == 10)
		{
	  		$isi =  wilayah_kelurahans::where('id','like', $wilayah_id)->value('nama');
	  	}
	  	elseif(strlen($wilayah_id) == 7)
	  	{
	  		$isi = wilayah_kecamatans::where('id','like', $wilayah_id)->value('nama');
	  	}
	  	elseif(strlen($wilayah_id) == 4)
	  	{
	  		$isi = wilayah_kotas::where('id','like', $wilayah_id)->value('nama');
	  	}

	  	$words = $isi;
	  	return $words;
	}

	function show_me_dmha_pengaturan($parent_id,$value)
	{
		return $words = pengaturan_02::where('parent_id','like',$parent_id)->value($value);
	}

	function show_me_kelurahan_id_where_kode_unik($id_param_1,$kode_unik,$sumber_data_pengisian_id,$pertanyaan_id)
	{
		$isi = '';

		$temp_data = data_02::select('02_data_details.isi')
							->join('02_data_details','02_data_details.berkas_data_id','02_data.berkas_data_id')
							->where('02_data.dmha_id','like',substr($id_param_1, 0, 4))
							->where('02_data.kode_unik','like',$kode_unik)
							->where('02_data.sumber_data_pengisian_id','=',$sumber_data_pengisian_id)
							->where('02_data_details.pertanyaan_id','=',$pertanyaan_id)
							->first();

		if (!empty($temp_data)) {
			$isi = $temp_data->isi;
		}

		$words = $isi;
		return $words;
	}

	function show_me_kelurahan_id_where_berkas_id($id_param_1,$berkas_id,$sumber_data_pengisian_id,$pertanyaan_id)
	{
		$isi = '';

		$temp_data = data_02::select('02_data_details.isi')
							->join('02_data_details','02_data_details.berkas_data_id','02_data.berkas_data_id')
							->where('02_data.dmha_id','like',substr($id_param_1, 0, 4))
							->where('02_data.berkas_id','=',$berkas_id)
							->where('02_data.sumber_data_pengisian_id','=',$sumber_data_pengisian_id)
							->where('02_data_details.pertanyaan_id','=',$pertanyaan_id)
							->first();

		if (!empty($temp_data)) {
			$isi = $temp_data->isi;
		}

		$words = $isi;
		return $words;
	}

	function show_me_link_path($id_param_1,$deskripsi_param_1,$nama_param_1)
	{
		$isi = '
		<li><a href="'.url('/').'/dashboard">Dashboard</a></li>';

		if($id_param_1 != '01')
		{
			$isi .= '
			<li><a href="'.url()->current().'">'.$deskripsi_param_1.'</a></li>
			<li class="active">'.$nama_param_1.'</li>
			';
		}

		$words = $isi;
		return $words;
	}

	function show_me_app_name()
	{
		return $words = app_mode::where('id','=','1')->value('nama');
	}

	function check_sdp_in_data_02($dmha_id,$PARAMETER_ID,$sumber_data_pengisian_id)
	{
		$isi = '';

		$tipe_data = give_me_quick_dmha($dmha_id,'tipe_data');

		if($tipe_data == 1)
		{
			$temp_data = data_02::where('dmha_id','like',substr($dmha_id, 0, 4))
							->where('kode_unik','like',$PARAMETER_ID)
							->where('sumber_data_pengisian_id','like',$sumber_data_pengisian_id)
							->get();
		}
		elseif($tipe_data == 2)
		{
			$temp_data = data_02::where('dmha_id','like',substr($dmha_id, 0, 4))
							->where('berkas_id','like',$PARAMETER_ID)
							->where('sumber_data_pengisian_id','like',$sumber_data_pengisian_id)
							->get();
		}

		if(count($temp_data) > 0)
		{
			$isi = 'in';
		}

		$words = $isi;
		return $words;
	}

	function read_row_all_database($database,$id,$coloumn)
	{
		if($database == 'sumber_data_pengisian')
		{
			return sumber_data_pengisians::where('id',$id)->value($coloumn);
		}
		elseif($database == 'ktps')
		{
			return ktps::where('id',$id)->value($coloumn);
		}
		elseif($database == 'pengaturan_02')
		{
			return pengaturan_02::where('parent_id','like',$id)->value($coloumn);
		}
		elseif($database == 'data_002914')
		{
			return data_002914::where('dmha_id','like',$id)->value($coloumn);
		}
	}

	function read_row_all_database_all_coloumn($database,$id)
	{
		if($database == 'sumber_data_pengisian')
		{
			return sumber_data_pengisians::where('id',$id)->first();
		}
		elseif($database == 'ktps')
		{
			return ktps::where('id',$id)->first();
		}
		elseif($database == 'pengaturan_02')
		{
			return pengaturan_02::where('parent_id','like',$id)->first();
		}
		elseif($database == 'data_002914')
		{
			return data_002914::where('dmha_id','like',$id)->first();
		}
	}

	function buat_berkas_id($parent_id_param_1,$kode_unik)
	{
		// Check $berkas_id terakhir berdasarkan kode unik
			$berkas_id_model = data_02::where('dmha_id','like',$parent_id_param_1)
					->max('berkas_id');

		// kalau belum ada $berkas_id_model, buat id baru
			if(is_null($berkas_id_model))
			{
				$berkas_id = 1;
			}
		// kalau sudah ada, 
			else
			{
				// check kode_unik dan berkas_id 
				$berkas_id_model_yang_sama = data_02::where('dmha_id','like',$parent_id_param_1)
						->where('berkas_id','=',$berkas_id_model)
						->first();

				// inisialisasi berkas id
				$berkas_id 	= $berkas_id_model;

				// kalau nggak sama
				if($berkas_id_model_yang_sama->kode_unik != $kode_unik)
				{
					$berkas_id 	= $berkas_id_model + 1;
				}						        	
			}

		return $berkas_id;
	}

	function buat_berkas_data_id($sumber_data_pengisian_id)
	{
		// Check $berkas_data_id terakhir berdasarkan kode unik
			$berkas_data_id_model = data_details_02::where('sumber_data_pengisian_id','=',$sumber_data_pengisian_id)
		        				->max('berkas_data_id');

		    $berkas_data_id_new 	= $berkas_data_id_model + 1;

		return $berkas_data_id_new;
	}

	function read_by_coloum_02($dmha_id,$berkas_id,$sumber_data_pengisian_id,$coloum)
    {
      	$temp_data =  data_02::where('dmha_id','like', $dmha_id)
              ->where('berkas_id','=', $berkas_id)              
              ->where('sumber_data_pengisian_id','=', $sumber_data_pengisian_id)
              ->value($coloum);

        if(is_null($temp_data))
        {
        	$temp_data = 0;
        }

        return $temp_data;
    }

    