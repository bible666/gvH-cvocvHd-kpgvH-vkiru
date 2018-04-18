

export class UserDataService{
    private user : UserData;
    
    getMenu():MenuData{
        let myMenu = localStorage.getItem('menu');
        let ret : MenuData = JSON.parse(myMenu);
        console.log(ret);
        return ret;
    }

    setUser(company_id:number,id : number,name : string,token : string){
        this.user = new UserData();
        this.user.userId = id;
        this.user.userName = name;
        this.user.token = token;
        this.user.company_id = company_id;
        localStorage.setItem('token',token);
       // console.log(localStorage.getItem('token'));
    }

    getUserId():number{
        return this.user.userId;
    }

    getUserName():string{
        return this.user.userName;
    }

    getUserToken():string{
        return localStorage.getItem('token');
    }
}

export class UserData{
    public token : string;
    public company_id : number;
    public userId : number;
    public userName : string;

}


export class MenuData{
    public menuID : number;
    public companyID : number;
    public titleLocal : string;
    public seqNumber : number;
    public urlPath : string;
    public childMenu : MenuData[];

}