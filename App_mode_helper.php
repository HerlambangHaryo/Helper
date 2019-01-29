<?php

	use App\app_mode;

	// app_mode
    // create_app_mode($APP_MODE)
	function create_app_mode($APP_MODE){
		// ------------------------------------------------------------------------- ACTION
			app_mode::double_app_mode_checking();

		    app_mode::insert(
		        [
		          'nama'  	=> $APP_MODE
		        ]
		    );
		//////////////////////////////////////////////////////////////////////////// 		
	}
