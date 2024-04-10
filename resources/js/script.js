function printTable() {
    var table = document.getElementById("myTable");
    var tableData = "";

    for (var i = 0; i < table.rows.length; i++) {
      for (var j = 0; j < table.rows[i].cells.length; j++) {
        tableData += table.rows[i].cells[j].innerText + "\t";
      }
      tableData += "\n";
    }

    console.log(tableData);
    window.print();
  }
