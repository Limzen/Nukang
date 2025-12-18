(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
		var a = 0;
		var b = 0;
		var c = 0;
		$(document).on('change','.qty',function(){
			var allsubtotal = 0;
			for(k=0;k<$('#jumlahmenu').val();k++)
			{
				var subtotal = $('#harga' + k).val() * $('#' + k).val();
				allsubtotal += subtotal;
			}
			allsubtotal *= $('#periodelangganan').val();
			$('#subtotaltext').text('Sub Total : Rp ' + allsubtotal.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
			$('#pajaktext').text('Biaya Lain - Lain (10%) : Rp ' + Number(allsubtotal * 10/100).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
			$('#totaltext').text('Total : Rp ' + Number(allsubtotal + allsubtotal * 10/100).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
			$('#total').val(Number(allsubtotal + allsubtotal * 10/100));
		});
		$(document).on('change','#periodelangganan',function(){
			var allsubtotal = 0;
			for(k=0;k<$('#jumlahmenu').val();k++)
			{
				var subtotal = $('#harga' + k).val() * $('#' + k).val();
				allsubtotal += subtotal;
			}
			allsubtotal *= $('#periodelangganan').val();
			$('#subtotaltext').text('Sub Total : Rp ' + allsubtotal.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
			$('#pajaktext').text('Biaya Lain - Lain (10%) : Rp ' + Number(allsubtotal * 10/100).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
			$('#totaltext').text('Total : Rp ' + Number(allsubtotal + allsubtotal * 10/100).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
			$('#total').val(Number(allsubtotal + allsubtotal * 10/100));
		});
		$('#tambahkurikulum').on('click', function() {
    		if($('#kategoripemesanan').val()=="0")
    		{
	    		if($('#kurikulumbox').val()=="")
	    			alert("Biaya Jasa Masi Kosong");
	    		else{
	    			$('#kurikulumdiv').append('<p id="kurikulumrow'+a+'">- '+$('#kurikulumjp').text()+'(Rp. '+Number($('#kurikulumbox').val()).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')+') <a style="cursor:pointer" class="hapuskurikulum" id="'+a+'">Hapus</a></p><input id="kurikulumhidden'+a+'" type="hidden" name="kurikulum[]" value="'+$('#kurikulumbox').val()+'"/><input id="kurikulumhiddenjp'+a+'" type="hidden" name="kurikulumjp[]" value="'+$('#kurikulumjp').val()+'"/>');
	    			$('#kurikulumbox').val("");
	    			a++;
	    		}
		    	
		    }
		    else
		    {
    			if($('#kurikulumbox2').val()=="")
	    			alert("Biaya Jasa Masi Kosong");
	    		else{
	    			$('#kurikulumdiv2').append('<p id="kurikulumrow2'+b+'">- '+$('#kurikulumjp').text()+'(Rp. '+Number($('#kurikulumbox').val()).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')+') <a style="cursor:pointer" class="hapuskurikulum2" id="'+b+'">Hapus</a></p><input id="kurikulumhidden2'+b+'" type="hidden" name="kurikulum2[]" value="'+$('#kurikulumbox').val()+'"/><input id="kurikulumhiddenjp2'+b+'" type="hidden" name="kurikulumjp2[]" value="'+$('#kurikulumjp').val()+'"/>');
	    			$('#kurikulumbox').val("");
	    			b++;
	    		}
		    }
		});
		$('#tambahkurikulum3').on('click', function() {
    		if($('#kurikulumbox3').val()=="")
    			alert("Informasi Pengalaman Yang Ditambahkan Kosong");
    		else{
    			$('#kurikulumdiv3').append('<p id="kurikulumrow3'+c+'">- '+$('#kurikulumbox3').val()+' <a style="cursor:pointer" class="hapuskurikulum3" id="'+c+'">Hapus</a></p><input id="kurikulumhidden3'+c+'" type="hidden" name="kurikulum3[]" value="'+$('#kurikulumbox3').val()+'"/>');
    			$('#kurikulumbox3').val("");
    			c++;
    		}
		});
		$(document).on('click','.hapuskurikulum',function(){
			$('#kurikulumrow' + this.id).remove();
			$('#kurikulumhidden' + this.id).remove();
			$('#kurikulumhiddenjp' + this.id).remove();
		});
		$(document).on('click','.hapuskurikulum2',function(){
			$('#kurikulumrow2' + this.id).remove();
			$('#kurikulumhidden2' + this.id).remove();
			$('#kurikulumhiddenjp2' + this.id).remove();
		});
		$(document).on('click','.hapuskurikulum3',function(){
			$('#kurikulumrow3' + this.id).remove();
			$('#kurikulumhidden3' + this.id).remove();
		});
		$('input:radio[name="jenis"]').change(function(){
			if($('input[name="jenis"]:checked').val()=='0')
			{
				$('#harian').css('display', 'block');
				$('#borongan').css('display', 'none');
				$('#tanggalselesai').css('display','none');
				$("#tanggalselesaitype").prop('required',false);
			}
			else
			{
				$('#harian').css('display', 'none');
				$('#borongan').css('display', 'block');
				$('#tanggalselesai').css('display','block');
				$("#tanggalselesaitype").prop('required',true);
			}
		});
		$('body').on("change","#uploadFile1", function()
    	{
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file
	            reader.onloadend = function(){ // set image data as background of div
	               $("#close1").css({
					    'font-size': '22px',
					    'color': 'red',
					    'display': 'block',
					    'cursor':'pointer',
					});
	                $("#imagePreview1").css("background-image", "url("+this.result+")");
	            }
	        }
    	});
    	$('#close1').on('click', function() {
    		$("#imagePreview1").css("background-image", "url('../../images/frontslider/addpicture.png')");
    		$("#close1").css("display","none");
    		$("#uploadFile1").val("");
    	});
    	$('body').on("change","#uploadFile2", function()
    	{
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file
	 
	            reader.onloadend = function(){ // set image data as background of div
	                $("#imagePreview2").css("background-image", "url("+this.result+")");
	            	$("#close2").css({
					    'font-size': '22px',
					    'color': 'red',
					    'display': 'block',
					    'cursor':'pointer',
					});
	            }
	        }
    	});
    	$('#close2').on('click', function() {
    		$("#imagePreview2").css("background-image", "url('../../images/frontslider/addpicture.png')");
    		$("#close2").css("display","none");
    		$("#uploadFile2").val("");
    	});

    	$('body').on("change","#uploadFile3", function()
    	{
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file
	 
	            reader.onloadend = function(){ // set image data as background of div
	                $("#imagePreview2").css("background-image", "url("+this.result+")");
	            	$("#close2").css({
					    'font-size': '22px',
					    'color': 'red',
					    'display': 'block',
					    'cursor':'pointer',
					});
	            }
	        }
    	});
    	$('body').on("change","#uploadFile4", function()
    	{
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file
	 
	            reader.onloadend = function(){ // set image data as background of div
	                $("#imagePreview2").css("background-image", "url("+this.result+")");
	            	$("#close2").css({
					    'font-size': '22px',
					    'color': 'red',
					    'display': 'block',
					    'cursor':'pointer',
					});
	            }
	        }
    	});
    	$('body').on("change","#uploadFile5", function()
    	{
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file
	 
	            reader.onloadend = function(){ // set image data as background of div
	                $("#imagePreview2").css("background-image", "url("+this.result+")");
	            	$("#close2").css({
					    'font-size': '22px',
					    'color': 'red',
					    'display': 'block',
					    'cursor':'pointer',
					});
	            }
	        }
    	});
		$('input:radio[name="jenis"]').change(function(){
			if($('input[name="jenis"]:checked').val()=='partaikecil')
			{
				$('#jumlahporsi').css('display', 'none');
				$('#textJumlah').removeAttr('required');
			}
			else
			{
				$('#jumlahporsi').css('display', 'block');
				$("#textJumlah").attr("required", "true");
			}
		});
		$('#exampleRiwayatTransaksi').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#exampleMenuPartaiKecil').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#exampleMenuPartaiBesar').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#examplePermintaanPesanan').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#exampleRating').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#examplePenyedia').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#exampleUpdateSaldo').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#examplePenarikan').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#examplePenyediaJasa').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#exampleKonsumen').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#exampleLaporanPemesanan').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#exampleLaporanTransaksi').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
		$('#examplePengembalian').dataTable({
		    "scrollX": true,
		    "deferRender": true,
		    "responsive": true,
		});
    });
}) (jQuery);
