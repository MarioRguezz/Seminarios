/**
 * Created by marioalbertonegreterodriguez on 26/03/17.
 */


class Choice {
    constructor(length) {
        this.guid = this.guid(),
        this.name = "Opcion",
        this.value = length;
    }


    tpl(){
        return "<div class='fullSize left box'><input type='radio'  value='"+this.value+"'> <input class='large' value='"+this.name + " "+this.value+"'/></div>";
    }


    .change(() => {
    console.log( select.val());
});


    guid () {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
            s4() + '-' + s4() + s4() + s4();
    }


}