<?php

	use App\data_002914;
	use App\app_list;
    use App\tipe_pertanyaans;

	// dashboard
    // create_menu_1_01($APP_MODE)
    function generate_search_single_data_ajax($AUTH_mas_id,$DMHA_ID,$PARENT_ID,$PARAM_2){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi    = '';

        // ------------------------------------------------------------------------- ACTION

            $isi    .= ' $("#searchme").keypress(function(e){ ' ;
            $isi    .= '  ' ;
            $isi    .= ' if(e.which == 13) { ' ;
            $isi    .= ' var value = $("#searchme").val(); ' ;
            $isi    .= ' $.ajax({ ' ;
            $isi    .= ' url: "'.url('/').'/Web_worker_table_general/generate_table", ' ;
            $isi    .= ' type: "POST", ' ;
            $isi    .= ' data: { ' ;
            $isi    .= ' "_token": "'.csrf_token().'", ' ;
            $isi    .= ' "dmha_id": "'.$DMHA_ID.'", ' ;
            $isi    .= ' "parent_id": "'.$PARENT_ID.'", ' ;
            $isi    .= ' "aumas": "'.$AUTH_mas_id.'", ' ;
            $isi    .= ' "screen_width": yourwidth, ' ;
            $isi    .= ' "param": "'.$PARAM_2.'", ' ;
            $isi    .= ' "value": value ' ;
            $isi    .= ' }, ' ;
            $isi    .= ' dataType: "json", ' ;
            $isi    .= ' cache: false, ' ;
            $isi    .= ' success: function(data){ ' ;
            $isi    .= ' $("#table").html(data.isi); ' ;
            $isi    .= ' FormSliderSwitcher.init(); ' ;
            $isi    .= ' } ' ;
            $isi    .= ' }); ' ;
            $isi    .= ' } ' ;
            $isi    .= ' }); ' ;

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////        
    }

    function generate_table_ajax($AUTH_mas_id,$DMHA_ID,$PARENT_ID,$PARAM_2){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi    = '';

        // ------------------------------------------------------------------------- ACTION
            $isi    .= ' $(document).ready(function() { ' ;
            $isi    .= ' $.ajax({ ' ;
            $isi    .= ' url: "'.url('/').'/Web_worker_table_general/generate_table", ' ;
            $isi    .= ' type: "POST", ' ;
            $isi    .= ' data: { ' ;
            $isi    .= ' "_token": "'.csrf_token().'", ' ;
            $isi    .= ' "dmha_id": "'.$DMHA_ID.'", ' ;
            $isi    .= ' "parent_id": "'.$PARENT_ID.'", ' ;
            $isi    .= ' "screen_width": yourwidth, ' ;
            $isi    .= ' "param": "'.$PARAM_2.'", ' ;
            $isi    .= ' "aumas": "'.$AUTH_mas_id.'" ' ;
            $isi    .= ' }, ' ;
            $isi    .= ' dataType: "json", ' ;
            $isi    .= ' cache: false, ' ;
            $isi    .= ' success: function(data){ ' ;
            $isi    .= ' $("#table").html(data.isi); ' ;
            $isi    .= ' FormSliderSwitcher.init(); ' ;
            $isi    .= ' } ' ;
            $isi    .= ' }); ' ;
            $isi    .= ' }); ' ;

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////        
    }


	function generate_sdp_form_ajax_data($DMHA_ID,$PARENT_ID,$TIPE_DATA_PARAM_1,$ID,$SUMBER_DATA_PENGISIAN_ID,$FORM_PARAM_1,$FORM_NAME_ID){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi    = '';

		// ------------------------------------------------------------------------- ACTION

            $isi    .= ' $(document).ready(function() { ' ;
            $isi    .= ' $.ajax({ ' ;
            $isi    .= ' url: "'.url('/').'/Web_worker_form_general/generate_sdp_form", ' ;
            $isi    .= ' data: { ' ;
            $isi    .= ' "dmha_id": "'.$DMHA_ID.'", ' ;
            $isi    .= ' "parent_id": "'.$PARENT_ID.'", ' ;
            $isi    .= ' "tipe_data": "'.$TIPE_DATA_PARAM_1.'", ' ;
            $isi    .= ' "ID": "'.$ID.'", ' ;         
            $isi    .= ' "sumber_data_pengisian_id": "'.$SUMBER_DATA_PENGISIAN_ID.'", ' ;
            $isi    .= ' "form": "'.$FORM_PARAM_1.'", ' ;
            $isi    .= ' }, ' ;
            $isi    .= ' dataType: "json", ' ;
            $isi    .= ' cache: false, ' ;
            $isi    .= ' success: function(data){ ' ;


            $isi    .= ' $("#form'.$FORM_NAME_ID.'").html(data.isi); ' ;
            $isi    .= ' App.init(); ' ;
            $isi    .= ' FormPlugins.init(); ' ;
            $isi    .= ' FormSliderSwitcher.init(); ' ;

            if($TIPE_DATA_PARAM_1 == 4){                
                $isi    .= ' $("#flash-session").html(data.status); ' ;
            }

            $isi    .= ' } ' ;
            $isi    .= ' }).done(function(data) { ' ;

            // --------------------------------------------------------------------- mask
                $isi_model = tipe_pertanyaans::read_pertanyaan_join_tipe_pertanyaans_by_sumber_data_pengisian_id_and_jquery($SUMBER_DATA_PENGISIAN_ID,'mask');

                if (count($isi_model) > 0) {
                    foreach ($isi_model as $row) {
                        if($row->id == 3){ // tanggal lahir
                            $isi    .= ' $(".'.$row->class.'").mask("99-99-9999"); ' ;
                        }elseif($row->id == 7){ // nik
                            $isi    .= ' $(".'.$row->class.'").mask("9999999999999999"); ' ;
                        }elseif($row->id == 19){ // nop
                            $isi    .= ' $(".'.$row->class.'").mask("99/99/9999"); ' ;
                        }
                    }
                }
            // --------------------------------------------------------------------- autocomplete
                $isi_model = tipe_pertanyaans::read_pertanyaan_join_tipe_pertanyaans_by_sumber_data_pengisian_id_and_jquery($SUMBER_DATA_PENGISIAN_ID,'autocomplete');

                if (count($isi_model) > 0) {
                    foreach ($isi_model as $row) {
                        if($row->id == 9){ // auto_nama_kota
                            $isi    .= ' 
                            $(function() {
                              $(".'.$row->class.'").autocomplete({
                                source: "'.url('/').'/Web_worker_form_general/generate_'.$row->class.'",

                                appendTo: "#modal-dialog-ktp"
                              });
                            });

                             ' ;
                        }elseif($row->id == 7){ // nik
                            $isi    .= ' $(".'.$row->class.'").mask("9999999999999999"); ' ;
                        }elseif($row->id == 19){ // nop
                            $isi    .= ' $(".'.$row->class.'").mask("99/99/9999"); ' ;
                        }
                    }
                }


            $isi    .= ' }); ' ;

            $isi    .= ' }); ' ;

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
		//////////////////////////////////////////////////////////////////////////// 		
	}

    function generate_ajax_submit($DMHA_ID,$PARENT_ID,$TIPE_DATA_PARAM_1,$ID,$SUMBER_DATA_PENGISIAN_ID,$FORM_PARAM_1,$FORM_NAME_ID){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi    = '';

        // ------------------------------------------------------------------------- ACTION

            $isi    .= ' $(document).on("click", "#submit", function(){ ' ;
            $isi    .= '  ' ;
            $isi    .= ' $.ajax({ ' ;
            $isi    .= ' url: "'.url('/').'/Web_worker_form_general/post_data", ' ;
            $isi    .= ' type: "POST", ' ;
            $isi    .= ' dataType: "json", ' ;
            $isi    .= ' data: { ' ;
            $isi    .= ' "_token": "{{ csrf_token() }}", ' ;
            $isi    .= ' "dmha_id": "'.$DMHA_ID.'", ' ;
            $isi    .= ' "tipe_data": "{{$TIPE_DATA_PARAM_1}}", ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;
            $isi    .= '  ' ;

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////        
    }

    function generate_ajax_CSRF(){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi    = '';

        // ------------------------------------------------------------------------- ACTION
            $isi    .= ' $.ajaxSetup({ ' ;
            $isi    .= ' headers: {"X-CSRF-Token": $("meta[name=token]").attr("content")} ' ;
            $isi    .= ' }); ' ;

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////        
    }

    function generate_table_multi_sdp_ajax($SUMBER_DATA_PENGISIAN_ID,$PARENT_ID,$KODE_UNIK){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi    = '';

        // ------------------------------------------------------------------------- ACTION
            $isi    .= ' $(document).ready(function() { ' ;
            $isi    .= ' $.ajax({ ' ;
            $isi    .= ' url: "'.url('/').'/Web_worker_table_general/generate_table_multi_sdp", ' ;
            $isi    .= ' data: { ' ;
            $isi    .= ' "sumber_data_pengisian_id": "'.$SUMBER_DATA_PENGISIAN_ID.'", ' ;
            $isi    .= ' "parent_id": "'.$PARENT_ID.'" ' ;
            $isi    .= ' "kode_unik": "'.$KODE_UNIK.'" ' ;
            $isi    .= ' }, ' ;
            $isi    .= ' dataType: "json", ' ;
            $isi    .= ' cache: false, ' ;
            $isi    .= ' success: function(data){ ' ;
            $isi    .= ' $("#table_multi_sdp_'.$SUMBER_DATA_PENGISIAN_ID.'").html(data.isi); ' ;
            $isi    .= ' } ' ;
            $isi    .= ' }); ' ;
            $isi    .= ' }); ' ;

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////        
    }


    function generate_accordion_ajax_custom_id($DMHA_ID,$PARENT_ID,$CUSTOM_ID,$PARAM_2){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi    = '';

        // ------------------------------------------------------------------------- ACTION
            $isi    .= ' $(document).ready(function() { ' ;
            $isi    .= ' $.ajax({ ' ;
            $isi    .= ' url: "'.url('/').'/Web_worker_table_general/generate_accordion", ' ;
            $isi    .= ' data: { ' ;
            $isi    .= ' "dmha_id": "'.$DMHA_ID.'", ' ;
            $isi    .= ' "parent_id": "'.$PARENT_ID.'", ' ;
            $isi    .= ' "param_2": "'.$PARAM_2.'", ' ;
            $isi    .= ' "id": "'.$CUSTOM_ID.'" ' ;
            $isi    .= ' }, ' ;
            $isi    .= ' dataType: "json", ' ;
            $isi    .= ' cache: false, ' ;
            $isi    .= ' success: function(data){ ' ;
            $isi    .= ' $("#'.$CUSTOM_ID.'").html(data.isi); ' ;
            $isi    .= ' } ' ;
            $isi    .= ' }); ' ;
            $isi    .= ' }); ' ;

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////        
    }