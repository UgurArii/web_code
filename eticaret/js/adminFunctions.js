    
    
function Aktif(id,alan,tablo,primaryKey){
			
		switch(alan){
			
			case "Aktif":
                            
			linkID = "#Aktif"+id;
			$(linkID).load("../inc/onay.php?PrimaryKey="+primaryKey+"&Tablo="+tablo+"&DegerID="+id+"&Alan="+alan);
			break;

			}
			}//aktif fns sonu