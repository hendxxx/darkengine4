var sourceTable, destTable; 

window.onload = function () {
	sourceTable = new SortedTable('s'); 
	destTable = new SortedTable('d'); 
	mySorted = new SortedTable(); 
	mySorted.colorize = function() { 
		for (var i=0;i<this.elements.length;i++) { 
			if (i%2){ 
				this.changeClass(this.elements[i],'even','odd'); 
			} else { 
				this.changeClass(this.elements[i],'odd','even'); 
			} 
		} 
	} 
	mySorted.onsort = mySorted.colorize; 
	mySorted.onmove = mySorted.colorize; 
	mySorted.colorize(); 
	secondTable = SortedTable.getSortedTable(document.getElementById('id')); 
	secondTable.allowDeselect = false; 
} 
function moveRows(s,d) { 
	var a = new Array(); 
	for (var o in s.selectedElements) { 
		a.push(s.selectedElements[o]); 
	} 
	for (var o in a) { 
		var elm = a[o]; 
		var tds = elm.getElementsByTagName('td'); 
		for (var i in tds) { 
			if (tds[i].headers) tds[i].headers = d.table.id+''+tds[i].headers.substr(d.table.id.length); 
		} 
		d.body.appendChild(a[o]); 
		d.deselect(a[o]); 
		d.init(d.table); 
		d.sort(); 
		s.deselect(a[o]); 
		s.init(s.table); 
	} 
} 
