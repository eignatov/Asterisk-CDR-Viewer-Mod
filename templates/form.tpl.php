<div id="main">
<table class="cdr cdr-main">
<tr>
<td>

<form method="post" enctype="application/x-www-form-urlencoded" action="">
<fieldset>
<legend class="title">Просмотр записей о совершенных звонках</legend>
<table width="100%">
<tr>
<th>Сортировать по</th>
<th>Условия поиска</th>
<th>&nbsp;</th>
</tr>
<tr>
<td><input <?php if (empty($_REQUEST['order']) || $_REQUEST['order'] == 'calldate') { echo 'checked="checked"'; } ?> id="id_order_calldate" type="radio" name="order" value="calldate">&nbsp;<label for="id_order_calldate">Дата</label></td>
<td>С&nbsp;
<input type="text" name="startday" id="startday" size="2" maxlength="2" value="<?php if (isset($_REQUEST['startday'])) { echo htmlspecialchars($_REQUEST['startday']); } else { echo date('d', time()); /* 01 */ } ?>">
<select name="startmonth" id="startmonth">
<?php
$months = array('01' => 'Январь', '02' => 'Февраль', '03' => 'Март', '04' => 'Апрель', '05' => 'Май', '06' => 'Июнь', '07' => 'Июль', '08' => 'Август', '09' => 'Сентябрь', '10' => 'Октябрь', '11' => 'Ноябрь', '12' => 'Декабрь');
foreach ($months as $i => $month) {
	if ((is_blank($_REQUEST['startmonth']) && date('m') == $i) || (isset($_REQUEST['startmonth']) && $_REQUEST['startmonth'] == $i)) {
		echo '<option value="'.$i.'" selected="selected">'.$month.'</option>';
	} else {
		echo '<option value="'.$i.'">'.$month.'</option>';
	}
}
?>
</select>
<select name="startyear" id="startyear">
<?php
for ( $i = 2000; $i <= date('Y'); $i++) {
	if ((empty($_REQUEST['startyear']) && date('Y') == $i) || (isset($_REQUEST['startyear']) && $_REQUEST['startyear'] == $i)) {
		echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
	} else {
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
}
?>
</select>&nbsp;
<input type="text" name="starthour" id="starthour" size="2" maxlength="2" value="<?php if (isset($_REQUEST['starthour'])) { echo htmlspecialchars($_REQUEST['starthour']); } else { echo '00'; } ?>">
:
<input type="text" name="startmin" id="startmin" size="2" maxlength="2" value="<?php if (isset($_REQUEST['startmin'])) { echo htmlspecialchars($_REQUEST['startmin']); } else { echo '00'; } ?>">&ensp;
По&ensp;
<input type="text" name="endday" id="endday" size="2" maxlength="2" value="<?php if (isset($_REQUEST['endday'])) { echo htmlspecialchars($_REQUEST['endday']); } else { echo '31'; } ?>">
<select name="endmonth" id="endmonth">
<?php
foreach ($months as $i => $month) {
	if ((is_blank($_REQUEST['endmonth']) && date('m') == $i) || (isset($_REQUEST['endmonth']) && $_REQUEST['endmonth'] == $i)) {
		echo '<option value="'.$i.'" selected="selected">'.$month.'</option>';
	} else {
		echo '<option value="'.$i.'">'.$month.'</option>';
	}
}
?>
</select>
<select name="endyear" id="endyear">
<?php
for ( $i = 2000; $i <= date('Y'); $i++) {
	if ((empty($_REQUEST['endyear']) && date('Y') == $i) || (isset($_REQUEST['endyear']) && $_REQUEST['endyear'] == $i)) {
		echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
	} else {
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
}
?>
</select>&nbsp;
<input type="text" name="endhour" id="endhour" size="2" maxlength="2" value="<?php if (isset($_REQUEST['endhour'])) { echo htmlspecialchars($_REQUEST['endhour']); } else { echo '23'; } ?>">
:
<input type="text" name="endmin" id="endmin" size="2" maxlength="2" value="<?php if (isset($_REQUEST['endmin'])) { echo htmlspecialchars($_REQUEST['endmin']); } else { echo '59'; } ?>">
</td>
<td rowspan="13" valign='top' align='right'>
<fieldset>
<legend class="title">Дополнительные опции</legend>
<table>
<tr>
<td>Тип отчета&ensp;</td>
<td>
<input <?php if ( (empty($_REQUEST['need_html']) && empty($_REQUEST['need_chart']) && empty($_REQUEST['need_chart_cc']) && empty($_REQUEST['need_minutes_report']) && empty($_REQUEST['need_asr_report']) && empty($_REQUEST['need_csv'])) || ( ! empty($_REQUEST['need_html']) &&  $_REQUEST['need_html'] == 'true' ) ) { echo 'checked="checked"'; } ?> type="checkbox" id="id_need_html" name="need_html" value="true">&ensp;<label for="id_need_html">Поиск в базе</label><br>
<?php
if ( strlen($callrate_csv_file) > 0 ) {
	//echo '&emsp;<input id="id_use_callrates" type="checkbox" name="use_callrates" value="true"';
	//if ( ! empty($_REQUEST['use_callrates']) &&  $_REQUEST['use_callrates'] == 'true' ) { echo 'checked="checked"'; }
	//if ( (empty($_REQUEST['need_html']) && empty($_REQUEST['need_chart']) && empty($_REQUEST['need_chart_cc']) && empty($_REQUEST['need_minutes_report']) && empty($_REQUEST['need_asr_report']) && empty($_REQUEST['need_csv'])) || ( ! empty($_REQUEST['use_callrates']) &&  $_REQUEST['use_callrates'] == 'true' )  ) { echo 'checked="checked"'; }
	//echo '>&ensp;<label for="id_use_callrates">С тарифами</label><br/>';
	if ( (empty($_REQUEST['need_html']) && empty($_REQUEST['need_chart']) && empty($_REQUEST['need_chart_cc']) && empty($_REQUEST['need_minutes_report']) && empty($_REQUEST['need_asr_report']) && empty($_REQUEST['need_csv'])) || ( ! empty($_REQUEST['need_html']) &&  $_REQUEST['need_html'] == 'true' ) ) { $_REQUEST['use_callrates'] = 'true'; }
} 
?>
<input <?php if ( ! empty($_REQUEST['need_csv']) && $_REQUEST['need_csv'] == 'true' ) { echo 'checked="checked"'; } ?> type="checkbox" id="id_need_csv" name="need_csv" value="true">&ensp;<label for="id_need_csv">CSV файл</label><br/>
<input <?php if ( ! empty($_REQUEST['need_chart']) && $_REQUEST['need_chart'] == 'true' ) { echo 'checked="checked"'; } ?> type="checkbox" id="id_need_chart" name="need_chart" value="true">&ensp;<label for="id_need_chart">График звонков</label><br>
<input <?php if ( ! empty($_REQUEST['need_minutes_report']) && $_REQUEST['need_minutes_report'] == 'true' ) { echo 'checked="checked"'; } ?> type="checkbox" id="id_need_minutes_report" name="need_minutes_report" value="true">&ensp;<label for="id_need_minutes_report">Расход минут</label><br>

<!-- Старый код - Concurrent Calls / ASR/ACD report -->

</td>
</tr>
<?php
if ( isset($plugins) && $plugins && count($plugins) > 0 ) {
	echo '<tr><td label for="Plugins">Плагины&ensp;</td><td><hr>';
	foreach ( $plugins as $p_key => $p_val ) {
		echo '<input id="id_need_'.$p_val.'" type="checkbox" name="need_'.$p_val.'" value="true" ';
		if ( ! empty($_REQUEST['need_'.$p_val]) && $_REQUEST['need_'.$p_val] == 'true' ) { 
			echo 'checked="checked"'; 
		}
		echo '>&ensp;<label for="id_need_'.$p_val.'">'. $p_key .'</label><br>';
	}
	echo '</td></tr>';
}
?>
<tr>
<td><label for="id_result_limit">Кол-во строк</label>&ensp;</td>
<td>
<hr>
<input id="id_result_limit" value="<?php 
if (isset($_REQUEST['limit']) ) { 
	echo htmlspecialchars($_REQUEST['limit']);
} else {
	echo $db_result_limit;
} ?>" name="limit" size="6">
</td>
</tr>
</table>
</fieldset>
</td>
</tr>

<!-- Старый код - Вх. канал -->

<tr>
<td><input <?php if (isset($_REQUEST['order']) && $_REQUEST['order'] == 'src') { echo 'checked="checked"'; } ?> type="radio" id="id_order_src" name="order" value="src">&nbsp;<label for="id_order_src">Номер звонящего</label></td>
<td><input class="margin-left0" type="text" name="src" id="src" value="<?php if (isset($_REQUEST['src'])) { echo htmlspecialchars($_REQUEST['src']); } ?>">
<input <?php if ( isset($_REQUEST['src_neg'] ) && $_REQUEST['src_neg'] == 'true' ) { echo 'checked="checked"'; } ?> type="checkbox" name="src_neg" value="true" id="id_src_neg"> <label for="id_src_neg">Не</label> &ensp;
<input <?php if (empty($_REQUEST['src_mod']) || $_REQUEST['src_mod'] == 'begins_with') { echo 'checked="checked"'; } ?> type="radio" name="src_mod" value="begins_with" id="id_src_mod1"> <label for="id_src_mod1">Начинается на</label> &ensp;
<input <?php if (isset($_REQUEST['src_mod']) && $_REQUEST['src_mod'] == 'contains') { echo 'checked="checked"'; } ?> type="radio" name="src_mod" value="contains" id="id_src_mod2"> <label for="id_src_mod2">Содержит</label> &ensp; 
<input <?php if (isset($_REQUEST['src_mod']) && $_REQUEST['src_mod'] == 'ends_with') { echo 'checked="checked"'; } ?> type="radio" name="src_mod" value="ends_with" id="id_src_mod3"> <label for="id_src_mod3">Кончается на</label> &ensp;
<input <?php if (isset($_REQUEST['src_mod']) && $_REQUEST['src_mod'] == 'exact') { echo 'checked="checked"'; } ?> type="radio" name="src_mod" value="exact" id="id_src_mod4"> <label for="id_src_mod4">Равно</label> 
</td>
</tr>

<!-- Старый код - Имя звонящего -->

<tr>
<td><input <?php if (isset($_REQUEST['order']) && $_REQUEST['order'] == 'dst') { echo 'checked="checked"'; } ?> type="radio" id="id_order_dst" name="order" value="dst">&nbsp;<label for="id_order_dst">Номер назначения</label></td>
<td><input class="margin-left0" type="text" name="dst" id="dst" value="<?php if (isset($_REQUEST['dst'])) { echo htmlspecialchars($_REQUEST['dst']); } ?>">
<input <?php if ( isset($_REQUEST['dst_neg'] ) &&  $_REQUEST['dst_neg'] == 'true' ) { echo 'checked="checked"'; } ?> type="checkbox" name="dst_neg" value="true" id="id_dst_neg"> <label for="id_dst_neg">Не</label> &ensp;
<input <?php if (empty($_REQUEST['dst_mod']) || $_REQUEST['dst_mod'] == 'begins_with') { echo 'checked="checked"'; } ?> type="radio" name="dst_mod" value="begins_with" id="id_dst_mod1"> <label for="id_dst_mod1">Начинается на</label> &ensp;
<input <?php if (isset($_REQUEST['dst_mod']) && $_REQUEST['dst_mod'] == 'contains') { echo 'checked="checked"'; } ?> type="radio" name="dst_mod" value="contains" id="id_dst_mod2"> <label for="id_dst_mod2">Содержит</label> &ensp; 
<input <?php if (isset($_REQUEST['dst_mod']) && $_REQUEST['dst_mod'] == 'ends_with') { echo 'checked="checked"'; } ?> type="radio" name="dst_mod" value="ends_with" id="id_dst_mod3"> <label for="id_dst_mod3">Кончается на</label> &ensp;
<input <?php if (isset($_REQUEST['dst_mod']) && $_REQUEST['dst_mod'] == 'exact') { echo 'checked="checked"'; } ?> type="radio" name="dst_mod" value="exact" id="id_dst_mod4"> <label for="id_dst_mod4">Равно</label> 
</td>
</tr>

<!-- Старый код - DID / Исх. канал / Userfield  / Account Code -->

<tr>
<td><input <?php if (isset($_REQUEST['order']) && $_REQUEST['order'] == 'duration') { echo 'checked="checked"'; } ?> type="radio" id="id_order_duration" name="order" value="duration">&nbsp;<label for="id_order_duration">Продолжительность</label></td>
<td><label for="id_dur_min">Между</label>&nbsp;
<input type="text" name="dur_min" id="id_dur_min" value="<?php if (isset($_REQUEST['dur_min'])) { echo htmlspecialchars($_REQUEST['dur_min']); } ?>" size="3" maxlength="5">&ensp;
И&ensp;
<input type="text" name="dur_max" id="id_dur_max" value="<?php if (isset($_REQUEST['dur_max'])) { echo htmlspecialchars($_REQUEST['dur_max']); } ?>" size="3" maxlength="5">
&nbsp;<label for="id_dur_max">Секунд</label>
</td>
</tr>
<tr>
<td><input <?php if (isset($_REQUEST['order']) && $_REQUEST['order'] == 'disposition') { echo 'checked="checked"'; } ?> type="radio" id="id_order_disposition" name="order" value="disposition">&nbsp;<label for="id_order_disposition">Статус звонка</label></td>
<td>
<input <?php if ( isset($_REQUEST['disposition_neg'] ) && $_REQUEST['disposition_neg'] == 'true' ) { echo 'checked="checked"'; } ?> class="margin-left0" type="checkbox" name="disposition_neg" id="id_disposition_neg" value="true"> <label for="id_disposition_neg">Не</label>&nbsp;
<select name="disposition" id="disposition">
<option <?php if (empty($_REQUEST['disposition']) || $_REQUEST['disposition'] == 'all') { echo 'selected="selected"'; } ?> value="all">Любой</option>
<option <?php if (isset($_REQUEST['disposition']) && $_REQUEST['disposition'] == 'ANSWERED') { echo 'selected="selected"'; } ?> value="ANSWERED">Отвечено</option>
<option <?php if (isset($_REQUEST['disposition']) && $_REQUEST['disposition'] == 'BUSY') { echo 'selected="selected"'; } ?> value="BUSY">Занято</option>
<option <?php if (isset($_REQUEST['disposition']) && $_REQUEST['disposition'] == 'FAILED') { echo 'selected="selected"'; } ?> value="FAILED">Ошибка</option>
<option <?php if (isset($_REQUEST['disposition']) && $_REQUEST['disposition'] == 'NO ANSWER') { echo 'selected="selected"'; } ?> value="NO ANSWER">Не отвечено</option>
</select>
</td>
</tr>
<tr>
<td>
<select name="sort" id="sort">
<option <?php if (isset($_REQUEST['sort']) && $_REQUEST['sort'] == 'ASC') { echo 'selected="selected"'; } ?> value="ASC">по возрастанию</option>
<option <?php if (empty($_REQUEST['sort']) || $_REQUEST['sort'] == 'DESC') { echo 'selected="selected"'; } ?> value="DESC">по убыванию</option>
</select>
</td>
<td>
	<label for="group">Группировать по</label>&nbsp;
	<select name="group" id="group">
	<optgroup label="Информация об аккаунте">
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'accountcode') { echo 'selected="selected"'; } ?> value="accountcode">Код аккаунта</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'userfield') { echo 'selected="selected"'; } ?> value="userfield">Польз. поле</option>
	</optgroup>
	<optgroup label="Дата / Время">
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'minutes1') { echo 'selected="selected"'; } ?> value="minutes1">Минута</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'minutes10') { echo 'selected="selected"'; } ?> value="minutes10">10 Минут</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'hour') { echo 'selected="selected"'; } ?> value="hour">Час</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'hour_of_day') { echo 'selected="selected"'; } ?> value="hour_of_day">Час дня</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'day_of_week') { echo 'selected="selected"'; } ?> value="day_of_week">День недели</option>
	<option <?php if (empty($_REQUEST['group']) || $_REQUEST['group'] == 'day') { echo 'selected="selected"'; } ?> value="day">День</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'week') { echo 'selected="selected"'; } ?> value="week">Неделя ( ПН-ВС )</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'month') { echo 'selected="selected"'; } ?> value="month">Месяц</option>
	</optgroup>
	<optgroup label="Номер телефона">
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'clid') { echo 'selected="selected"'; } ?> value="clid">Имя звонящего</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'src') { echo 'selected="selected"'; } ?> value="src">Номер звонящего</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'did') { echo 'selected="selected"'; } ?> value="dst">DID</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'dst') { echo 'selected="selected"'; } ?> value="dst">Номер назначения</option>
	</optgroup>
	<optgroup label="Тех. информация">
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'disposition') { echo 'selected="selected"'; } ?> value="disposition">Статус</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'disposition_by_day') { echo 'selected="selected"'; } ?> value="disposition_by_day">Статус по дням</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'disposition_by_hour') { echo 'selected="selected"'; } ?> value="disposition_by_hour">Статус по часам</option>
	<option <?php if (isset($_REQUEST['group']) && $_REQUEST['group'] == 'dcontext') { echo 'selected="selected"'; } ?> value="dcontext">Контекст</option>
	</optgroup>
	</select>
</td>
</tr>
<tr>
<td>
&nbsp;
</td>
<td>
<input class="submit btnSearch" type="submit" value="Найти">
<input <?php if (empty($_REQUEST['search_mode']) || $_REQUEST['search_mode'] == 'all') { echo 'checked="checked"'; } ?> type="radio" id="id_search_mode_all" name="search_mode" value="all"> <label for="id_search_mode_all">По всем статусам</label>&ensp;
<input <?php if (isset($_REQUEST['search_mode']) && $_REQUEST['search_mode'] == 'any') { echo 'checked="checked"'; } ?> type="radio" id="id_search_mode_any" name="search_mode" value="any"> <label for="id_search_mode_any">По любому статусу</label>
</td>
</tr>
</table>
</fieldset>
</form>
</td>
</tr>
</table>
<a id="CDR"></a>

