//编辑器专用。

KindEditor.ready(function(K) {
	var editor1 = K.create('textarea[name="content1"]', {
	cssPath : '../kindeditor/plugins/code/prettify.css',
	uploadJson : '../kindeditor/php/upload_json.php',
	fileManagerJson : '../kindeditor/php/file_manager_json.php',
	allowFileManager : true,
	afterCreate : function() {
	var self = this;
	K.ctrl(document, 13, function() {
	self.sync();
	K('form[name=example]')[0].submit();
	});

	K.ctrl(self.edit.doc, 13, function() {
	self.sync();
	K('form[name=example]')[0].submit();
	});
	}
	});
	prettyPrint();
});

$(document).ready(function(){
	//根据tr的奇偶性判断该行显示的颜色。
	$('#tb tr:even').css("backgroundColor","#0EF");//奇数行颜色为#0EF
	$('#tb tr:odd').css("backgroundColor","#fff");//偶数行颜色为#FFF
	
	//复选框全选操作。	
	$("#chk2").click(function(){ 
		if(this.checked)
			$("input[id='chk1']").each(function(){this.checked=true;});
		else
			$("input[id='chk1']").each(function(){this.checked=false;});
	});	
});
	
//JS方法有一个缺点就是当子项只有一项时，方法调用就会失效，不能获取ch。
/*
function check(){
	var ch = document.fmEdit.chk1;
	for(var i=0;i<ch.length;i++){
		ch[i].checked=document.fmEdit.chk2.checked;
	}
}
*/
	
	


