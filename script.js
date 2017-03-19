(function($) {
	"use strict";

	if ($("#syrusSeoDefaultMetaTitle").length) {
		$("#sseo_title_count").html('<strong>' + $("#syrusSeoDefaultMetaTitle").val().length + '</strong>');
	}

	if ($("#syrusSeoDefaultMetaDescription").length) {
		$("#sseo_desc_count").html('<strong>' + $("#syrusSeoDefaultMetaDescription").val().length + '</strong>');
	}

	if ($("#syrusSeoMetaTitle").length) {
		$("#sseo_title_count").html('<strong>' + $("#syrusSeoMetaTitle").val().length + '</strong>');
	}

	if ($("#syrusSeoMetaDescription").length) {
		$("#sseo_desc_count").html('<strong>' + $("#syrusSeoMetaDescription").val().length + '</strong>');
	}

	$('#syrusSeoMetaTitle').change(function() {
		var count = $(this).val().length;
		$("#sseo_title_count").html('<strong>' + count + '</strong>');
	});
	$('#syrusSeoMetaTitle').keypress(function() {
		var count = $(this).val().length;
		$("#sseo_title_count").html('<strong>' + count + '</strong>');
	});
	$('#syrusSeoMetaTitle').bind('paste', function() {
		var count = $(this).val().length;
		$("#sseo_title_count").html('<strong>' + count + '</strong>');
	});

	$('#syrusSeoDefaultMetaTitle').change(function() {
		var count = $(this).val().length;
		$("#sseo_title_count").html('<strong>' + count + '</strong>');
	});
	$('#syrusSeoDefaultMetaTitle').keypress(function() {
		var count = $(this).val().length;
		$("#sseo_title_count").html('<strong>' + count + '</strong>');
	});
	$('#syrusSeoDefaultMetaTitle').bind('paste', function() {
		var count = $(this).val().length;
		$("#sseo_title_count").html('<strong>' + count + '</strong>');
	});

	$('#syrusSeoMetaDescription').change(function() {
		var count = $(this).val().length;
		$("#sseo_desc_count").html('<strong>' + count + '</strong>');
	});
	$('#syrusSeoMetaDescription').keypress(function() {
		var count = $(this).val().length;
		$("#sseo_desc_count").html('<strong>' + count + '</strong>');
	});
	$('#syrusSeoMetaDescription').bind('paste', function() {
		var count = $(this).val().length;
		$("#sseo_desc_count").html('<strong>' + count + '</strong>');
	});

	$('#syrusSeoMetaDescription').change(function() {
		var count = $(this).val().length;
		$("#sseo_desc_count").html('<strong>' + count + '</strong>');
	});
	$('#syrusSeoMetaDescription').keypress(function() {
		var count = $(this).val().length;
		$("#sseo_desc_count").html('<strong>' + count + '</strong>');
	});
	$('#syrusSeoMetaDescription').bind('paste', function() {
		var count = $(this).val().length;
		$("#sseo_desc_count").html('<strong>' + count + '</strong>');
	});
})(jQuery);
