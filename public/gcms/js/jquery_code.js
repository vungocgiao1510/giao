$(document).ready(function() {
	$("#checkedAll").change(function() {
		if (this.checked) {
			$(".checkSingle").each(function() {
				this.checked = true;
			})
		} else {
			$(".checkSingle").each(function() {
				this.checked = false;
			})
		}
	});

	$(".checkSingle").click(function() {
		if ($(this).is(":checked")) {
			var isAllChecked = 0;
			$(".checkSingle").each(function() {
				if (!this.checked)
					isAllChecked = 1;
			})
			if (isAllChecked == 0) {
				$("#checkedAll").prop("checked", true);
			}
		} else {
			$("#checkedAll").prop("checked", false);
		}
	});
	
	/*
	 * Ajax jQuery
	 * Phần select box số hiển thị bài viết
	 */
	$("#numberpage").change(function(){
		number = $("#numberpage").val();
		$.ajax({
			"url":baseUrl+"gcms/user/shownumber",
			"type":"POST",
			"data":"number="+number,
			"success":function(result){
				location.reload();
//				$("#result").html(result);
			}
		})
	});
});