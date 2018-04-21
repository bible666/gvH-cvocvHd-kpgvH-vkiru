
import { Injectable } from '@angular/core';

@Injectable()
export class UserDataService{
    private user : UserData;
    
    public getMenu():MenuData[]{
        let myMenu = localStorage.getItem('menu');
        console.log(myMenu);
        let jsonObj  = JSON.parse(myMenu);
        console.log(jsonObj.menuDatas);
        let ret: MenuData[]  = jsonObj;
        console.log(ret);
        return jsonObj.menuDatas;
    }

    public setUser(company_id:number,id : number,name : string,token : string){
        localStorage.setItem('userId',id.toString());
        localStorage.setItem('userName',name);
        localStorage.setItem('companyId',company_id.toString());
        localStorage.setItem('token',token);
    }

    public getUserId():number{
        return this.user.userId;
    }

    public getUserName():string{
        return localStorage.getItem('userName');
    }

    public getUserToken():string{
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