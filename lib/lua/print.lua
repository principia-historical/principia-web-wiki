
local buffer = {}

return {
	write = function(text)
		table.insert(buffer, text)
	end,
	output = function()
		io.write(table.concat(buffer, ""))
	end
}
