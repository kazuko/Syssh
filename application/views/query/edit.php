<? javascript('query_add')?>
<form method="post">
	<div class="contentTableMenu">
		<div class="right">
			<input type="submit" name="submit[query]" value="保存" />
			<input type="submit" name="submit[cancel]" value="取消" />
			|
			<input type="submit" name="submit[advanced]" value="高级" title="切换到高级模式，当前输入的数据不会被保存！" />
		</div>
	</div>
	<div class="contentTableBox">
		<div class="contentTable">
	
			<div class="item">
				<div class="title"><label>咨询人：</label></div>
				
				<input type="text" name="client[name]" value="<?=$this->value('client/name')?>" placeholder="姓名" autocomplete="client" style="width:65%" />
				<span class="autocomplete-no-result-menu">
					<? displayRadio(array('男','女'),'client[gender]',$this->value('client/gender')) ?>
				</span>
				<select name="query[query_type]" style="width:11%">
					<? displayOption(array('_ENUM','case','query_type'),$this->value('query/query_type'))?>
				</select>
				<input type="text" name="query[first_contact]" value="<?=$this->value('query/first_contact')?>" title="首次接待时间" class="date" style="width:11%" />
			</div>
	
			<div class="item autocomplete-no-result-menu" style="display: block;">
				<div class="title"><label>来源：</label></div>
				<select name="source[type]" style="width:33%">
					<? displayOption(array('_ENUM','client_source','type'),$this->value('source/type'))?>
				</select>
				<input type="text" name="source[detail]" value="<?=$this->value('source/detail') ?>" disabled="disabled" placeholder="具体来源" style="width:32%;display:none" />
				<input type="text" name="client_extra[source_lawyer_name]" value="<?=$this->value('client_extra/source_lawyer_name') ?>" title="来源律师" placeholder="来源律师" style="width:33%" />
			</div>
	
			<div class="item autocomplete-no-result-menu" style="display: block;">
				<div class="title"><label>联系方式：</label></div>
				<input type="text" name="client_contact_extra[phone]" value="<?=$this->value('client_contact_extra/phone'); ?>" title="电话" placeholder="电话" style="width:49%" />
				<input type="text" name="client_contact_extra[email]" value="<?=$this->value('client_contact_extra/email'); ?>" title="电子邮件" placeholder="电子邮件" style="width:49%" />
			</div>
	
			<div class="item">
				<div class="title"><label>跟进人员：</label></div>
	
				<input type="text" name="case_lawyer_extra[partner_name]" value="<?=$this->value('case_lawyer_extra/partner_name')?>" title="督办合伙人" placeholder="督办合伙人" style="width:33%" />
	
				<input type="text" name="case_lawyer_extra[lawyer_name]" value="<?=$this->value('case_lawyer_extra/lawyer_name')?>" title="接洽律师" placeholder="接洽律师" style="width:32%" />
	
				<input type="text" name="case_lawyer_extra[assistant_name]" value="<?=$this->value('case_lawyer_extra/assistant_name')?>" title="协助接洽" placeholder="协助接洽" style="width:32%" />
	
			</div>
			
			<div class="item">
				<div class="title"><label>概况：</label></div>
				<textarea name="query[summary]" rows="7"><?=$this->value('query/summary'); ?></textarea>
			</div>
	
			<div class="item">
				<div class="title"><label>报价：</label></div>
				<input type="text" name="query[quote]" value="<?=$this->value('query/quote');?>" />
			</div>
			
			<div class="item">
				<div class="title"><label>备注：</label></div>
				<textarea name="query[comment]"><?=$this->value('query/comment'); ?></textarea>
			</div>
	
			<div class="submit">
				<input type="submit" name="submit[query]" value="保存" />
				<input type="submit" name="submit[cancel]" value="取消" />
			</div>
		</div>
	</div>
</form>