

export class UserDataService{
    private user : UserData;

    setUser(company_id:number,id : number,name : string,token : string){
        this.user = new UserData();
       this.user.userId = id;
       this.user.userName = name;
       this.user.token = token;
       this.user.company_id = company_id;
    }

    getUserId():number{
        return this.user.userId;
    }

    getUserName():string{
        return this.user.userName;
    }

    getUserToken():string{
        return this.user.token;
    }
}

export class UserData{
    public token : string;
    public company_id : number;
    public userId : number;
    public userName : string;

}