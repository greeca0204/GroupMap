<?php /* Smarty version 2.6.18, created on 2014-05-23 09:09:16
         compiled from editUserInfo.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form name="fmEdit" id="fmEdit" method="post" action="userInfo.php?action=save" enctype="multipart/form-data">
	<input type="hidden" name="uid" id="uid" value="<?php echo $this->_tpl_vars['userInfo']['uid']; ?>
" />
	<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
		<tr>
			<td width="10%">用户ID：</td>
			<td>
				<input name="uid" id="uid" value="<?php echo $this->_tpl_vars['userInfo']['uid']; ?>
"  class="frminput" />
			</td>
		</tr>
		<tr>
			<td width="10%">用户名称：</td>
			<td>
				<input name="username" id="username" value="<?php echo $this->_tpl_vars['userInfo']['username']; ?>
"  class="frminput" />
			</td>
		</tr>
		<tr>
			<td width="10%">手机账户：</td>
			<td>
				<input name="telAccount" id="telAccount" value="<?php echo $this->_tpl_vars['userInfo']['telAccount']; ?>
"  class="frminput" />
			</td>
		</tr>
		<tr>
			<td width="10%">国家代码</td>
			<td>
				<input name="nationNo" id="nationNo" value="<?php echo $this->_tpl_vars['userInfo']['nationNo']; ?>
" class="frminput"/>
			</td>
		</tr>
        <tr>
			<td width="10%">密保邮箱：</td>
			<td>
				
                <input id="sex" name="sex" type="radio" value="1" <?php if ($this->_tpl_vars['userInfo']['sex'] == 1): ?>checked="checked"<?php endif; ?> />男&nbsp;&nbsp;
                <input id="sex" name="sex" type="radio" value="0" <?php if ($this->_tpl_vars['userInfo']['sex'] == 0): ?>checked="checked"<?php endif; ?> />女
			</td>
		</tr>
		<tr>
			<td width="10%">密保邮箱：</td>
			<td>
				<input name="email" id="email" value="<?php echo $this->_tpl_vars['userInfo']['email']; ?>
" class="frminput"/>
			</td>
		</tr>
        <tr>
			<td width="10%">状态：</td>
			<td>
				<select id="status" name="status">
                	<option value="0" <?php if ($this->_tpl_vars['userInfo']['status'] == 0): ?>selected="selected"<?php endif; ?>>无效</option>
                    <option value="1" <?php if ($this->_tpl_vars['userInfo']['status'] == 1): ?>selected="selected"<?php endif; ?>>有效</option>
                    <option value="2" <?php if ($this->_tpl_vars['userInfo']['status'] == 2): ?>selected="selected"<?php endif; ?>>在线</option>
                </select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="提交">
				<input type="reset" value="重置">
			</td>
		</tr>
	</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>