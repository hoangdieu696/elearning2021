//******************************************************************************
//******************************************************************************
function getRequest(link, func){
	var http = new XMLHttpRequest();
	http.open('GET', link);
	http.onreadystatechange = function(){
		if(http.readyState == 4 && http.status == 200){
			func(http.responseText);
		}
	}
	http.send(null);
}

function postRequest(link, data, func){
	var http = new XMLHttpRequest();
	http.open('POST', link, true);
	http.onreadystatechange = function(){
		if(http.readyState == 4 && http.status == 200){
			func(http.responseText);
		}
	}
	http.send(data);
}
//******************************************************************************
//******************************************************************************
function stringLimitLength(str, limit){
	if(str.length <= limit) 
		return str;
	return str.substring(0, limit) + "..."; 
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function getById(id){
	return document.getElementById(id);
}

function getByName(name){
	return document.getElementsByName(name);
}

function signup(){
	var data = new FormData();
	data.append('request', 'true');
	data.append('fullname', document.getElementsByName('fullname')[0].value);
	data.append('email', document.getElementsByName('email')[0].value);
	data.append('mobile', document.getElementsByName('mobile')[0].value);
	data.append('username', document.getElementsByName('username')[0].value);
	data.append('password', document.getElementsByName('password')[0].value);
	data.append('password2', document.getElementsByName('password2')[0].value);
	data.append('type', document.getElementsByName('account_type')[0].checked ? '3' : '2');
	data.append('childID', document.getElementsByName('childID')[0].value);

	postRequest('signup_action.php', data, function(resp){
		switch(resp){
		case "Error: username_exist":
			alert("Username is exist. Please try another!");
			break;
		case "Error: password_short":
			alert("Password is too short. The minimum length is 8!");
			break;
		case "Error: password_mismatch":
			alert("Repeat password is not match. Please try again!");
			break;
		case "Error: fullname_empty":
			alert("Full name is empty!");
			break;
		case "Error: username_empty":
			alert("Username is empty!");
			break;
		case "Error: childID_notfound":
			alert("Your child's ID is not found!");
			break;
		case "OK":
			location.href = "./";
		default:
			break;
		}
	});
}

function loadInfo(){
	var data = new FormData();
	data.append('request', 'true');
	postRequest('./info/get_info_action.php', data, function(resp){
		getById('infoModalBody').innerHTML = resp;
	});
}

function updateInfo(obj){
	var data = new FormData();
	data.append('request', 'true');
	data.append('fullname', getById('fullname').value);
	data.append('email', getById('email').value);
	data.append('mobile', getById('mobile').value);
	postRequest('./info/update_info_action.php', data, function(resp){
		switch(resp){
			case "OK":
				alert("Update the information successful!");
				obj.previousElementSibling.click();
				break;
			case "Error: fullname_empty":
				alert("Full name is empty!");
				break;
		}
	});
}

function updatePassword(obj){
	var data= new FormData();
	data.append('request', 'true');
	data.append('oldpass', getById('old_pass').value);
	data.append('newpass', getById('new_pass').value);
	data.append('newpass2', getById('new_pass2').value);
	postRequest("?action=update_password_act", data, function(resp){
	alert(resp);
		switch(resp){
			case "UpdatePasswordOK":
				alert("Thay đổi thành công!");
				getById('old_pass').value = '';
				getById('new_pass').value = '';
				getById('new_pass2').value = '';
				obj.previousElementSibling.click();
				break;
			case "Error: oldpassword_wrong":
				alert("Nhập sai mật khẩu cũ!");
				break;
			case "Error: password_short":
				alert("Mật khẩu quá ngắn. Độ dài tối thiểu là 8!");
				break;
			case "Error: password_mismatch":
				alert("Nhập lại mật khẩu không trùng khớp. Hãy nhập lại!");
				break;
		}
	});
}

function loadCategoryList(){
	getRequest("?action=get_category_list_act", function(resp){
		var data = JSON.parse(resp);
		getById("categorylist_body").innerHTML = "";
		for(var i = 0; i < data.length; i++){
			var trElem = document.createElement("tr");
			trElem.id = data[i]["category_id"];
			var tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["category_id"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			var aElem = document.createElement("a");
			aElem.href = "?link=subcategory&category=" + data[i]["category_id"];
			aElem.innerHTML = data[i]["name"];
			tdElem.appendChild(aElem);
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = "<button class=\"btn btn-primary\" onclick=\"loadCategory(this.parentElement.parentElement.id)\" data-toggle=\"modal\" data-target=\"#updateCategoryModal\"><i class=\"fas fa-edit fsize14\"></i></button>"
					 + " <button class=\"btn btn-warning\" onclick=\"removeCategory(this.parentElement.parentElement.id)\"><i class=\"fas fa-trash-alt fsize14\"></i></button>";
			trElem.appendChild(tdElem);
			getById("categorylist_body").appendChild(trElem);
		}
	});
}
function addCategory(){
	var fd = new FormData();
	fd.append("name", getById("category_name").value);
	postRequest("?action=add_category_act", fd, function(resp){
		getById('category_name').value = "";
		if(resp == "AddCategoryOK") loadCategoryList();
	});
}
function loadCategory(id){
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=get_category_act", fd, function(resp){
		var form = getById('updateCategoryForm');
		var data = JSON.parse(resp);
		form[0].value = data['category_id'];
		form[1].value = data['name'];
	});
}
function updateCategory(id){
	var fd = new FormData();
	fd.append("id", id);
	var form = getById("updateCategoryForm");
	fd.append("name", form[1].value);
	postRequest("?action=update_category_act", fd, function(resp){
		if(resp == "UpdateCategoryOK"){
			form[0].value = form[1].value = "";
			loadCategoryList();
		}
	});
}
function removeCategory(id){
	var cf = confirm("Bạn có chắc muốn xóa mục này?");
	if(!cf) return;
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=remove_category_act", fd, function(resp){
		if(resp == "RemoveCategoryOK"){
			loadCategoryList();
		}
	});
}

function loadSubCategoryList(){
	var fd = new FormData();
	fd.append("category_id", getUrlVars()['category']);
	postRequest("?action=get_subcategory_list_act", fd, function(resp){
		var data = JSON.parse(resp);
		getById("subcategorylist_body").innerHTML = "";
		for(var i = 0; i < data.length; i++){
			var trElem = document.createElement("tr");
			trElem.id = data[i]["sub_category_id"];
			var tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["sub_category_id"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["name"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = "<button class=\"btn btn-primary\" onclick=\"loadSubCategory(this.parentElement.parentElement.id)\" data-toggle=\"modal\" data-target=\"#updateSubCategoryModal\"><i class=\"fas fa-edit fsize14\"></i></button>"
					 + " <button class=\"btn btn-warning\" onclick=\"removeSubCategory(this.parentElement.parentElement.id)\"><i class=\"fas fa-trash-alt fsize14\"></i></button>";
			trElem.appendChild(tdElem);
			getById("subcategorylist_body").appendChild(trElem);
		}
	});
}
function addSubCategory(){
	var fd = new FormData();
	fd.append("name", getById("subcategory_name").value);
	fd.append("category_id", getUrlVars()["category"]);
	postRequest("?action=add_subcategory_act", fd, function(resp){
		getById('subcategory_name').value = "";
		if(resp == "AddSubCategoryOK") loadSubCategoryList();
	});
}
function loadSubCategory(id){
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=get_subcategory_act", fd, function(resp){
		var form = getById('updateSubCategoryForm');
		var data = JSON.parse(resp);
		form[0].value = data['sub_category_id'];
		form[1].value = data['name'];
	});
}
function updateSubCategory(id){
	var fd = new FormData();
	fd.append("id", id);
	var form = getById("updateSubCategoryForm");
	fd.append("name", form[1].value);
	postRequest("?action=update_subcategory_act", fd, function(resp){
		if(resp == "UpdateSubCategoryOK"){
			form[0].value = form[1].value = "";
			loadSubCategoryList();
		}
	});
}
function removeSubCategory(id){
	var cf = confirm("Bạn có chắc muốn xóa mục này?");
	if(!cf) return;
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=remove_subcategory_act", fd, function(resp){
		if(resp == "RemoveSubCategoryOK"){
			loadSubCategoryList();
		}
	});
}

function loadSubCategorySelectList(objId, value){
	var fd = new FormData();
	fd.append("category_id", value);
	postRequest("?action=get_subcategory_list_act", fd, function(resp){
		var data = JSON.parse(resp);
		var obj = getById(objId);
		obj.innerHTML = "";
		var optionElem = document.createElement("option");
		optionElem.value = "0";
		optionElem.innerHTML = "Chọn mục con";
		obj.appendChild(optionElem);
		for(var i = 0; i < data.length; i++){
			optionElem = document.createElement("option");
			optionElem.value = data[i]['sub_category_id'];
			optionElem.innerHTML = data[i]['name'];
			obj.appendChild(optionElem);
		}
	});
}
function loadProductList(objId, value){
	var obj = getById(objId);
	var fd = new FormData();
	fd.append("sub_category_id", value);
	postRequest("?action=get_product_list_act", fd, function(resp){
		obj.innerHTML = "";
		if(resp == "[]") return;
		var data = JSON.parse(resp);
		for(var i = 0; i < data.length; i++){
			var trElem = document.createElement("tr");
			trElem.id = data[i]["product_id"];
			var tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["product_id"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			var imgElem = document.createElement("img");
			imgElem.src = "../Resource/Images/" + data[i]["image"].split(";")[0];
			imgElem.style.height = "150px";
			imgElem.style.width = "auto";
			tdElem.appendChild(imgElem);
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["name"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = "<button class=\"btn btn-success\" title=\"Nhập kho\" onclick=\"getById('product_import_id').innerText=this.parentElement.parentElement.id\" data-toggle=\"modal\" data-target=\"#importProductModal\"><i class=\"fas fa-download fsize14\"></i></button> "
					+ " <button class=\"btn btn-primary\" title=\"Kiểm kho\" onclick=\"checkProduct(this.parentElement.parentElement.id)\" data-toggle=\"modal\" data-target=\"#viewProductModal\"><i class=\"fas fa-archive fsize14\"></i></button>" 
					+ " <button class=\"btn btn-warning\" title=\"Chỉnh sửa\" onclick=\"loadProduct(this.parentElement.parentElement.id)\" data-toggle=\"modal\" data-target=\"#updateProductModal\"><i class=\"fas fa-edit fsize14\"></i></button>"
					+ " <button class=\"btn btn-danger\" title=\"Xóa\" onclick=\"removeProduct(this.parentElement.parentElement.id)\"><i class=\"fas fa-trash-alt fsize14\"></i></button>";
			trElem.appendChild(tdElem);
			obj.appendChild(trElem);
		}
	});
}
function addProduct(){
	if(getById("subcategory_select").value == "0"){
		alert("Chưa chọn mục cho sản phẩm!");
	}
	else{
		var form = getById("addProductForm");
		var fd = new FormData();
		fd.append('name', getById("product_name").value);
		fd.append("register_number", getById("product_reg").value);
		fd.append('summary', tinymce.EditorManager.get('product_summary').getContent({format: 'raw'}));
		fd.append("content", tinymce.EditorManager.get('product_content').getContent({format: 'raw'}));
		fd.append("price", getById("product_price").value);
		fd.append("sale", getById("product_sale").value);
		fd.append("origin", getById("product_origin").value);
		fd.append("brand", getById("product_brand").value);
		fd.append("packing", getById("product_packing").value);
		fd.append("ingredient", getById("product_ingredient").value);
		var imgList = getByName("product_image");
		for(var i = 0; i < imgList.length; i++){
			fd.append('image[]', imgList[i].files[0]);
		}
		fd.append("sub_category_id", getById("subcategory_select").value);
		postRequest('?action=add_product_act', fd, function(resp){
			for(var i = 0; i < form.length; i++) form[i].value = "";
			tinymce.EditorManager.get('product_summary').setContent("");
			tinymce.EditorManager.get('product_content').setContent("");
			getById('imgChooserPanel').innerHTML = 
				"<div class='col-md-3'>\n" + 
				"<div style='width: 100%; height: 100%;'>\n" + 
				"<button class='close' type='button' style='position: relative; top: 3px; left: -28px; display: none; z-index: 100;' onclick='delImgChooser(this)'>×</button>\n" + 
				"<input type='file' name='prod_image' style='display: none;'><img src='assets/img/plus.png' class='imgChooserBg' onclick='chooseImg(this)'>\n" + 
				"</div>\n" + 
				"</div>";
			loadProductList('productlist_body', getById("subcategory_select").value);
		});
	}
}

function chooseImg(obj, input_name){
    var x = obj.previousElementSibling;
    x.click();
    x.onchange = function(e){
        var reader = new FileReader();
        reader.readAsDataURL(e.srcElement.files[0]);
        reader.onload = function(e){
            obj.src = e.target.result;
        }
        obj.previousElementSibling.previousElementSibling.style.display = 'block';
        var check = document.getElementsByName(input_name);
        if(check[check.length - 1].value != ""){
            createImgChooser(obj.parentElement.parentElement.parentElement, input_name);
        }
    }
}
function createImgChooser(obj, input_name){
    var item = document.createElement('div');
    item.className = 'col-md-3';
    item.innerHTML = "<div style='width: 100%; height: 100%;'>\n" + 
    					"<button class='close' type='button' style='position: relative; top: 3px; left: -28px; display: none; z-index: 100;' onclick='delImgChooser(this)'>×</button>\n" + 
    					"<input type='file' name='" + input_name + "' style='display: none;'>\n" + 
    					"<img src='assets/img/plus.png' class='imgChooserBg' onclick=\"chooseImg(this, '" + input_name + "')\">\n" + 
    				 "</div>";
    obj.appendChild(item);
}
function delImgChooser(obj){
    obj.parentElement.parentElement.parentElement.removeChild(obj.parentElement.parentElement);
}

function loadProduct(id){
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=get_product_act", fd, function(resp){
		var data = JSON.parse(resp);
		getById("product_id_update").value = data["product_id"];
		getById("product_name_update").value = data["name"];
		getById("product_reg_update").value = data["register_number"];
		tinymce.EditorManager.get('product_summary_update').setContent(data["summary"]);
		tinymce.EditorManager.get('product_content_update').setContent(data["content"]);
		getById("product_feature_update").checked = data["is_feature"] == "1" ? true : false;
		getById("product_price_update").value = data["price"];
		getById("product_sale_update").value = data["sale"];
		getById("product_origin_update").value = data["origin"];
		getById("product_brand_update").value = data["brand"];
		getById("product_packing_update").value = data["packing"];
		getById("product_ingredient_update").value = data["ingredient"];
		var imgList = data["image"].split(";");
		getById("imgChooserPanelUpdate").innerHTML = "";
		for(var i = 0; i < imgList.length; i++){
			var div = document.createElement("div");
			div.className = "col-md-3";
			div.innerHTML = "<div style=\"width: 100%; height: 100%;\">"
				+ "<button class=\"close\" type=\"button\" style=\"position: relative; top: 3px; left: -28px; display: block; z-index: 100;\" onclick=\"delImgChooser(this)\">×</button>"
				+ "<input type=\"hidden\" name=\"product_image_update\" value=\"" + imgList[i] + "\">"
				+ "<img src=\"../Resource/Images/" + imgList[i] + "\" class=\"imgChooserBg\" onclick=\"chooseImg(this, 'product_image_update')\">"
				+ "</div>";
			getById("imgChooserPanelUpdate").appendChild(div);
		}
		var div = document.createElement("div");
		div.className = "col-md-3";
		div.innerHTML = "<div style=\"width: 100%; height: 100%;\">"
			+ "<input type=\"file\" name=\"product_image_update\" style=\"display: none;\">"
			+ "<img src=\"assets/img/plus.png\" class=\"imgChooserBg\" onclick=\"chooseImg(this, 'product_image_update')\">"
			+ "</div>";
		getById("imgChooserPanelUpdate").appendChild(div);
	});
}
function updateProduct(){
	var fd = new FormData();
	fd.append("product_id", getById("product_id_update").value);
	fd.append("register_number", getById("product_reg_update").value);
	fd.append("name", getById("product_name_update").value);
	fd.append("summary", tinymce.EditorManager.get('product_summary_update').getContent({format: 'raw'}));
	fd.append("content", tinymce.EditorManager.get('product_content_update').getContent({format: 'raw'}));
	fd.append("price", getById("product_price_update").value);
	fd.append("sale", getById("product_sale_update").value);
	fd.append("origin", getById("product_origin_update").value);
	fd.append("brand", getById("product_brand_update").value);
	fd.append("packing", getById("product_packing_update").value);
	fd.append("ingredient", getById("product_ingredient_update").value);
	fd.append("is_feature", getById("product_feature_update").checked ? "1" : "0");
	var imgList = getByName("product_image_update");
	for(var i = 0; i < imgList.length; i++){
		if(imgList[i].type == "hidden") fd.append("images[]", imgList[i].value);
		else if(imgList[i].type == "file") fd.append("image[]", imgList[i].files[0]);
	}
	postRequest("?action=update_product_act", fd, function(resp){
		if(resp == "UpdateProductOK"){
			getById("product_id_update").value = "";
			getById("product_name_update").value = "";
			getById("product_reg_update").value = "";
			getById("product_price_update").value = "";
			getById("product_sale_update").value = "";
			getById("product_origin_update").value = "";
			getById("product_brand_update").value = "";
			getById("product_packing_update").value = "";
			getById("product_ingredient_update").value = "";
			getById("product_feature_update").checked = false;
			tinymce.EditorManager.get('product_summary_update').setContent("");
			tinymce.EditorManager.get('product_content_update').setContent("");
			getById("imgChooserPanelUpdate").innerHTML = "<div class=\"col-md-3\">"
				+ "<div style=\"width: 100%; height: 100%;\">"
				+ "<button class=\"close\" type=\"button\" style=\"position: relative; top: 3px; left: -28px; display: block; z-index: 100;\" onclick=\"delImgChooser(this)\">×</button>"
				+ "<input type=\"file\" name=\"product_image_update\" style=\"display: none;\">"
				+ "<img src=\"assets/img/plus.png\" class=\"imgChooserBg\" onclick=\"chooseImg(this, 'product_image_update')\">"
				+ "</div>"
				+ "</div>";
			loadProductList('productlist_body', getById("subcategory_select").value);
		}
	})
}
function removeProduct(id){
	var cf = confirm("Bạn có chắc muốn xóa sản phẩm này?");
	if(!cf) return;
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=remove_product_act", fd, function(resp){
		if(resp == "RemoveProductOK"){
			loadProductList('productlist_body', getById("subcategory_select").value);
		}
	});
}
function importProduct(id){
	var fd = new FormData();
	fd.append("product_id", id);
	fd.append("register_id", getById("register_id").value);
	fd.append("number", getById("number").value);
	fd.append("expired_date", getById("expired_date").value);
	postRequest("?action=import_product_act", fd, function(resp){
		console.log(resp);
		if(resp == "ImportProductOK"){
			getById("register_id").value = "";
			getById("number").value = "1";
			getById("expired_date").valueAsDate = new Date();
			alert("Đã nhập kho!");
		}
	});
}
function checkProduct(id){
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=check_remain_product_act", fd, function(resp){
		console.log(resp);
		var data = JSON.parse(resp);
		getById("remainProductListBody").innerHTML = "";
		for(var i = 0; i < data.length; i++){
			var trElem = document.createElement("tr");
			var tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["product_id"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = "<img src=\"../Resource/Images/" + data[i]["image"] + "\" style=\"height: 150px; width: auto;\">";
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["name"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["register_id"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["expired_date"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["number"];
			trElem.appendChild(tdElem);
			getById("remainProductListBody").appendChild(trElem);
		}
	});
}
function loadExpiredProductList(){
	var fd = new FormData();
	fd.append("type", getById("expired_type").value);
	postRequest("?action=get_expired_product_list_act", fd, function(resp){
		var data = JSON.parse(resp);
		getById("expiredlist_body").innerHTML = "";
		for(var i = 0; i < data.length; i++){
			var trElem = document.createElement("tr");
			var tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["product_id"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = "<img src=\"../Resource/Images/" + data[i]["image"] + "\" style=\"height: 150px; width: auto;\">";
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["name"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["register_id"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["expired_date"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["number"];
			trElem.appendChild(tdElem);
			getById("expiredlist_body").appendChild(trElem);
		}
	});
}

// exam 
function changeStatus($id){
	var fd = new FormData();
	fd.append("exam_id", $id);

	postRequest("?action=update_status_exam_act", fd, function(resp){
		window.location.reload();
	});
}

function addExam($id){
	// console.log($id);
	var fd = new FormData();
	fd.append("exam_id", $id);
	getById("exam_id_add").value = $id;
	console.log(getById("exam_id_add").value);
}

function addUsers($id){
	// console.log($id);
	var fd = new FormData();
	fd.append("exam_id_add", $id);
	getById("exam_id_add_user").value = $id;
	console.log(getById("exam_id_add_user").value);
}

function checkFilesExist($id) {
	console.log($id);
	var fd = new FormData();
	fd.append("exam_id", $id);


	postRequest("?action=check_files_exist_act", fd, function(resp){
		console.log(resp);
		
		if(resp == "OK"){
			getById("check_exist").textContent = "Đã có đề";
        }else{
            getById("check_exist").textContent = "Chưa có đề";
        }
        console.log(getById("check_exist").textContent);
        // window.location.reload();
	});
}

function getExamDetail($id){
	var fd = new FormData();
	fd.append("exam_id", $id);
	
	postRequest("?action=get_exam_act", fd, function(resp){
		var data = JSON.parse(resp);
		getById("exam_id_update").value = data["exam_id"];
		getById("name_update").value = data["name"];
		getById("start_exam_update").value = data["start_exam"];
		getById("end_exam_update").value = data["end_exam"];
		getById("is_actived_update").value = data["is_actived"];
		if(data["is_actived"] == 0) getById("is_actived_update").checked = false;
		else getById("is_actived_update").checked = true;
	});
}

function loadDiseaseList(){
	getRequest("?action=get_disease_list_act", function(resp){
		var data = JSON.parse(resp);
		getById("diseaselist_body").innerHTML = "";
		for(var i = 0; i < data.length; i++){
			var trElem = document.createElement("tr");
			trElem.id = data[i]["disease_id"];
			var tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["disease_id"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["name"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = stringLimitLength(data[i]["content"], 400);
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = "<button class=\"btn btn-primary\" onclick=\"loadDisease(this.parentElement.parentElement.id)\" data-toggle=\"modal\" data-target=\"#updateDiseaseModal\"><i class=\"fas fa-edit fsize14\"></i></button>"
					 + " <button class=\"btn btn-warning\" onclick=\"removeDisease(this.parentElement.parentElement.id)\"><i class=\"fas fa-trash-alt fsize14\"></i></button>";
			trElem.appendChild(tdElem);
			getById("diseaselist_body").appendChild(trElem);
		}
	});
}
function addDisease(){
	var fd = new FormData();
	fd.append("name", getById("disease_name").value);
	fd.append("content", tinymce.EditorManager.get('disease_content').getContent({format : 'raw'}));
	postRequest("?action=add_disease_act", fd, function(resp){
		if(resp == "AddDiseaseOK"){
			getById("disease_name").value = "";
			tinymce.EditorManager.get('disease_content').setContent("");
			loadDiseaseList();
		}
	});
}
function loadDisease(id){
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=get_disease_act", fd, function(resp){
		var data = JSON.parse(resp);
		getById("disease_id_update").value = data["disease_id"];
		getById("disease_name_update").value = data["name"];
		tinymce.EditorManager.get('disease_content_update').setContent(data["content"]);
	});
}
function updateDisease(id){
	var fd = new FormData();
	fd.append("id", getById("disease_id_update").value);
	fd.append("name", getById("disease_name_update").value);
	fd.append("content", tinymce.EditorManager.get('disease_content_update').getContent({format: 'raw'}));
	postRequest("?action=update_disease_act", fd, function(resp){
		if(resp == "UpdateDiseaseOK"){
			getById("disease_id_update").value = "";
			getById("disease_name_update").value = "";
			tinymce.EditorManager.get('disease_content_update').setContent("");
			loadDiseaseList();
		}
	});
}
function removeDisease(id){
	var cf = confirm("Bạn có chắc muốn xóa mục này?");
	if(!cf) return;
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=remove_disease_act", fd, function(resp){
		if(resp == "RemoveDiseaseOK"){
			loadDiseaseList();
		}
	});
}

function loadTintucList(){
	getRequest("?action=get_tintuc_list_act", function(resp){
		var data = JSON.parse(resp);
		getById("diseaselist_body").innerHTML = "";
		for(var i = 0; i < data.length; i++){
			var trElem = document.createElement("tr");
			trElem.id = data[i]["tintuc_id"];
			var tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["tintuc_id"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["name"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = stringLimitLength(data[i]["content"], 400);
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = "<button class=\"btn btn-primary\" onclick=\"loadTintuc(this.parentElement.parentElement.id)\" data-toggle=\"modal\" data-target=\"#updateDiseaseModal\"><i class=\"fas fa-edit fsize14\"></i></button>"
					 + " <button class=\"btn btn-warning\" onclick=\"removeTintuc(this.parentElement.parentElement.id)\"><i class=\"fas fa-trash-alt fsize14\"></i></button>";
			trElem.appendChild(tdElem);
			getById("diseaselist_body").appendChild(trElem);
		}
	});
}
function addTintuc(){
	var fd = new FormData();
	fd.append("name", getById("disease_name").value);
	fd.append("content", tinymce.EditorManager.get('disease_content').getContent({format : 'raw'}));
	postRequest("?action=add_tintuc_act", fd, function(resp){
		if(resp == "AddDiseaseOK"){
			getById("disease_name").value = "";
			tinymce.EditorManager.get('disease_content').setContent("");
			loadTintucList();
		}
	});
}
function loadTintuc(id){
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=get_tintuc_act", fd, function(resp){
		var data = JSON.parse(resp);
		getById("disease_id_update").value = data["tintuc_id"];
		getById("disease_name_update").value = data["name"];
		tinymce.EditorManager.get('disease_content_update').setContent(data["content"]);
	});
}
function updateTintuc(id){
	var fd = new FormData();
	fd.append("id", getById("disease_id_update").value);
	fd.append("name", getById("disease_name_update").value);
	fd.append("content", tinymce.EditorManager.get('disease_content_update').getContent({format: 'raw'}));
	postRequest("?action=update_tintuc_act", fd, function(resp){
		if(resp == "UpdateDiseaseOK"){
			getById("disease_id_update").value = "";
			getById("disease_name_update").value = "";
			tinymce.EditorManager.get('disease_content_update').setContent("");
			loadTintucList();
		}
	});
}
function removeTintuc(id){
	var cf = confirm("Bạn có chắc muốn xóa mục này?");
	if(!cf) return;
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=remove_tintuc_act", fd, function(resp){
		if(resp == "RemoveDiseaseOK"){
			loadTintucList();
		}
	});
}

function loadOrderList(){
	var fd = new FormData();
	fd.append("status", getById("status_select").value);
	postRequest("?action=get_order_list_act", fd, function(resp){
		var data = JSON.parse(resp);
		getById("orderlist_body").innerHTML = "";
		for(var i = 0; i < data.length; i++){
			var trElem = document.createElement("tr");
			trElem.id = data[i]["bill_id"];
			var tdElem = document.createElement("td");
			tdElem.innerHTML = data[i]["time"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = "<a href=\"#\" data-toggle=\"modal\" data-target=\"#orderDetailModal\" onclick=\"loadBillDetail(" + data[i]["bill_id"] + ")\">" + data[i]["customer"] + "</a>";
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = Intl.NumberFormat('vi-VI', { maximumSignificantDigits: 3 }).format(parseInt(data[i]["price"])) + " VND";
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = 
				"<button class=\"btn btn-success\" style=\"margin-right:10px\" title=\"Đã giao\" onclick=\"updateOrderStatus(" + data[i]["bill_id"] + ",'received')\"><i class=\"fa fa-check\"></i></button>"
				+ "<button class=\"btn btn-warning\" style=\"margin-right:10px\" title=\"Đang giao\" onclick=\"updateOrderStatus(" + data[i]["bill_id"] + ",'delivery')\"><i class=\"fa fa-plane\"></i></button>"
				+ "<button class=\"btn btn-danger\" title=\"Chưa giao\" onclick=\"updateOrderStatus(" + data[i]["bill_id"] + ",'pending')\"><i class=\"fa fa-times\"></i></button>";
			trElem.appendChild(tdElem);
			getById("orderlist_body").appendChild(trElem);
		}
	});
}
function updateOrderStatus(id, status){
	var cf = confirm("Bạn có chắc muốn thay đổi trạng thái đơn hàng này?");
	if(!cf) return;
	var fd = new FormData();
	fd.append("bill_id", id);
	fd.append("status", status);
	postRequest("?action=update_order_status_act", fd, function(resp){
		if(resp == "UpdateOrderStatusOK"){
			loadOrderList();
		}
	});
}
function loadBillDetail(id){
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=get_order_detail_act", fd, function(resp){
		var data = JSON.parse(resp);
		var total = 0;
		getById("orderDetailBody").innerHTML = "";
		for(var i = 0; i < data.length; i++){
			var div1 = document.createElement("div");
			div1.className = "row";
			var div2 = document.createElement("div");
			div2.className = "col-md-4";
			div2.innerHTML = data[i]["product_name"];
			div1.appendChild(div2);
			div2 = document.createElement("div");
			div2.className = "col-md-3";
			div2.innerHTML = Intl.NumberFormat('vi-VI', { maximumSignificantDigits: 3 }).format(parseInt(data[i]["price"]));
			div1.appendChild(div2);
			div2 = document.createElement("div");
			div2.className = "col-md-1";
			div2.innerHTML = "x" + data[i]["number"];
			div1.appendChild(div2);
			div2 = document.createElement("div");
			div2.className = "col-md-3";
			div2.innerHTML = Intl.NumberFormat('vi-VI', { maximumSignificantDigits: 3 }).format(parseInt(data[i]["price"]) * parseInt(data[i]["number"])) + " VND";
			total += parseInt(data[i]["price"]) * parseInt(data[i]["number"]);
			div1.appendChild(div2);
			getById("orderDetailBody").appendChild(div1);
		}
		var div1 = document.createElement("div");
		div1.style.paddingTop = "20px";
		div1.className = "row";
		div2 = document.createElement("div");
		div2.className = "col-md-4";
		div2.innerHTML = "";
		div1.appendChild(div2);
		div2 = document.createElement("div");
		div2.className = "col-md-4";
		div2.innerHTML = "<b>Tổng</b>";
		div1.appendChild(div2);
		div2 = document.createElement("div");
		div2.className = "col-md-3";
		div2.innerHTML = Intl.NumberFormat('vi-VI', { maximumSignificantDigits: 3 }).format(total) + " VND";
		div1.appendChild(div2);
		getById("orderDetailBody").appendChild(div1);
	});
}

function loadAdvertisementList(){
	getRequest("?action=get_advertisement_list_act", function(resp){
		var data = JSON.parse(resp);
		getById("advertisementlist_body").innerHTML = "";
		for(var i = 0; i < data.length; i++){
			var trElem = document.createElement("tr");
			trElem.id = data[i]["id"];
			var tdElem = document.createElement("td");
			tdElem.innerText = data[i]["pos"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = "<img style=\"height: 150px; width: auto;\" src=\"../Resource/Advertisement/" + data[i]['image'] + "\">";
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = 
			"<button class=\"btn btn-primary\" onclick=\"loadAdvertisement(this.parentElement.parentElement.id)\" data-toggle=\"modal\" data-target=\"#updateAdvertisementModal\"><i class=\"fas fa-edit fsize14\"></i></button>"
			+ " <button class=\"btn btn-warning\" onclick=\"removeAdvertisement(this.parentElement.parentElement.id)\"><i class=\"fas fa-trash-alt fsize14\"></i></button>";
			trElem.appendChild(tdElem);
			getById("advertisementlist_body").appendChild(trElem);
		}
	})
}
function addAdvertisement(){
	var fd = new FormData();
	fd.append('image', getById("advertisement_image").files[0]);
	postRequest("?action=add_advertisement_act", fd, function(resp){
		if(resp == "AddAdvertisementOK"){
			getById("advertisement_image").value = "";
			loadAdvertisementList();
		}
	});
}
function loadAdvertisement(id){
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=get_advertisement_act", fd, function(resp){
		var data = JSON.parse(resp);
		getById("")
	});
}
function updateAdvertisement(id){

}
function removeAdvertisement(id){
	var cf = confirm("Bạn muốn xóa ảnh này?");
	if(!cf) return;
	var fd = new FormData();
	fd.append("id", id);
	postRequest("?action=remove_advertisement_act", fd, function(resp){
		if(resp == "RemoveAdvertisementOK"){
			loadAdvertisementList();
		}
	});
}
function loadMessageList(){
	getRequest("?action=load_message_list_act", function(resp){
		getById("messagelist_body").innerText = "";
		var data = JSON.parse(resp);
		for(var i = 0; i < data.length; i++){
			var trElem = document.createElement("tr");
			var tdElem = document.createElement("td");
			tdElem.innerText = data[i]["time"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerText = data[i]["name"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			if(data[i]["isread"] == "0" && data[i]["direction"] == "1")
				tdElem.innerHTML = "<span style=\"font-weight: 900;\">" + data[i]["content"] + "</span>";
			else
				tdElem.innerText = data[i]["content"];
			trElem.appendChild(tdElem);
			tdElem = document.createElement("td");
			tdElem.innerHTML = 
			"<button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#messageModal\" onclick=\"loadMessage('" + data[i]["uid"] + "')\"><i class=\"fa fa-eye\"></i></button> "
			+ "<button class=\"btn btn-danger\" onclick=\"removeMessage('" + data[i]["uid"] + "')\"><i class=\"fa fa-trash\"></i></button>";
			trElem.appendChild(tdElem);
			getById("messagelist_body").appendChild(trElem);
		}
	});
}
var updateNewMessageInterval;
function loadMessage(uid){
	var fd = new FormData();
	fd.append("uid", uid);
	getById("messId").innerHTML = uid;
	postRequest("?action=load_message_act", fd, function(resp){
		getById("message-body").innerText = "";
		var info = JSON.parse(resp)["user"];
		var data = JSON.parse(resp)["message"];
		getById("messName").innerText = info["name"];
		for(var i = 0; i < data.length; i++){
			var div = document.createElement("div");
			if(data[i]["direction"] == "0"){
				div.style = "border-radius: 20px; background-color: #4e73df; color: #fff; padding: 10px; margin-bottom: 5px; width: 80%; margin-left: 20%;"
			}
			else{
				div.style = "border-radius: 20px; background-color: rgb(96 103 103); color: #fff; padding: 10px; margin-bottom: 5px; width: 80%; margin-right: 20%;"
			}
			div.innerHTML = data[i]["content"];
			getById("message-body").appendChild(div);
		}
		getById('message-body').scrollTo(0, getById('message-body').scrollHeight);
	});
	updateNewMessageInterval = setInterval(function(){ updateNewMessage(); }, 5000);
}
function sendMessageEnterKeyPress(event, obj){
	if(event.keyCode == 13) sendMessage(obj.value);
}
function sendMessage(mess){
	var fd = new FormData();
	fd.append("uid", getById("messId").innerHTML);
	fd.append("message", mess);
	if(mess.trim() == "") return;
	postRequest("?action=send_message_act", fd, function(resp){
		getById("chat-send-content").value = "";
		if(resp == "SendOK"){
			var div = document.createElement("div");
			div.style = "border-radius: 20px; background-color: #4e73df; color: #fff; padding: 10px; margin-bottom: 5px; width: 80%; margin-left: 20%;";
			div.innerHTML = mess;
			getById('message-body').appendChild(div);
			getById('message-body').scrollTo(0, getById('message-body').scrollHeight);
		}
	});
}
function updateNewMessage(){
	var fd = new FormData();
	fd.append("uid", getById("messId").innerHTML);
	postRequest("?action=update_new_message_act", fd, function(resp){
		var data = JSON.parse(resp);
		for(var i = 0; i < data.length; i++){
			if(data[i]['content'].trim() != ""){
				var div = document.createElement("div");
				div.style = "border-radius: 20px; background-color: rgb(208 211 220); color: #fff; padding: 10px; margin-bottom: 5px; width: 80%; margin-right: 20%;";
				div.innerHTML = data[i]['content'];
				getById('message-body').appendChild(div);
				getById('message-body').scrollTo(0, getById('message-body').scrollHeight);
			}
		}
	})
}
function closeMessageFormm(){
	getById("messId").innerHTML = "";
	clearInterval(updateNewMessageInterval);
}
function removeMessage(id){
	var cf = confirm("Bạn muốn xóa tin nhắn này?");
	if(!cf) return;
	var fd = new FormData();
	fd.append("uid", id);
	postRequest("?action=remove_message_act", fd, function(resp){
		if(resp == "RemoveMessageOK"){
			loadMessageList();
		}
	})
}