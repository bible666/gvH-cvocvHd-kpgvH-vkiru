import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { routerTransition } from '../router.animations';
import { HttpClient } from '@angular/common/http';
import { FormGroup, FormControl, Validator, Validators } from '@angular/forms';
import { environment } from "../../environments/environment";
import { UserDataService, MenuData } from '../service/userData.service';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss'],
    animations: [routerTransition()]
})
export class LoginComponent implements OnInit {

    private userService: UserDataService;
    constructor(public router: Router, private http: HttpClient) {
        this.userService = new UserDataService();
    }

    formLogin = new FormGroup({
        'username': new FormControl('admin',[
            Validators.required,
            Validators.minLength(3)
        ]),
        'password': new FormControl('password',Validators.required)
    });

    get username(){
        return this.formLogin.get('username');
    }

    get password(){
        return this.formLogin.get('password');
    }

    ngOnInit() {

    }

    onLoggedin() {
        //alert(this.username.value);
        let post = { 
            login : this.username.value,
            password : this.password.value
        };
        //console.log(JSON.stringify(post));
        this.http.post<myData>(
            environment.apiUrl + 'Users/login.json',
            JSON.stringify(post)
        ).subscribe(data=>{

            this.userService.setUser(data.usersData.company_id, data.usersData.id,data.usersData.user_name,data.token);

            let post = { 
                token : data.token
            };

            //Get Menu Data <MenuData>
            this.http.post(
                environment.apiUrl + 'Users/getMenu.json',
                JSON.stringify(post)
            ).subscribe(data=>{
                var myJSON = JSON.stringify(data);
                //console.log(myJSON);
                localStorage.setItem('isLoggedin', 'true');
                localStorage.setItem('menu', myJSON);
                //console.log(this.userService.getMenu());
                this.router.navigate(['/dashboard']);
            },error=>{});
            //
            
            //
            //console.log(this.userService.getUserToken());
        },error =>{
            //console.log(error.status);
            alert('Login Error');
            localStorage.setItem('isLoggedin', 'false');
        });
        
        
        
    }
}

export class myData{
    public token : string;
    public usersData : UData;
}

export class UData{
    public id : number;
    public company_id : number;
    public user_name : string;
}
