local l, json, data = ...

l.write(string.format([[
<div class="infobox">
	<table>
		<tr><td class="heading" colspan="2">%s</td></tr>
		<tr><th>ID</th><td>%s</td></tr>
		<tr><th>Name</th><td>%s</td></tr>
		<tr><th>Category</th><td>%s</td></tr>
		<tr><th>Added in</th><td>%s</td></tr>
	</table>
</div>
]], data.name, data.id, data.name, data.category, data.version))

l.output()
