<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Str;

class General {
	/**
	 * Digunakan untuk upload file secara general
	 *
	 * @param [type] $file_upload
	 * @param [type] $name
	 * @param [type] $location
	 * @param boolean $format_name_slug digunakan untuk mengidentifikasi apakah penamaan menggunakan slug atau tidak
	 * @param boolean $time digunakan untuk mengidentifikasikan apakah menambahkan waktu yang akan dicantumkan kedalam penamaan
	 * @param string $disk
	 * @return void
	 */
	public static function uploadFile($file_upload, $name, $location, $format_name_slug = true, $time = false, $disk = 'public')
	{
		if ($format_name_slug) {
			$file = Str::slug($name) . ($time ? '-'. time() : '') . '.' . $file_upload->getClientOriginalExtension();

		} else {
			$file = $name . ($time ? '-' . time() : '') . '.' . $file_upload->getClientOriginalExtension();
		}
		// example
		// without time & format = false : Document Name.pdf
		// with time & format = true     : document-name-1699260534.pdf


		$path = storage_path('app/public/' . $location); // otomatis masuk ke folder storage

		if (!File::isDirectory($path))
		{
			File::makeDirectory($path, 0777, true, true);
		}

		// Process and store the uploaded file
		if ($file_upload) {
			$file_location = $file_upload->storeAs($location, $file, $disk);
		}

		return [
			'file_location'  		=> $file_location,
			'origin_file_save_name' => $file,
			'extension'				=> pathinfo($file_location, PATHINFO_EXTENSION)
		];
	}
}
