import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { routerTransition } from '../router.animations';
import { HttpClient } from '@angular/common/http';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss'],
    animations: [routerTransition()]
})
export class LoginComponent implements OnInit {
    constructor(public router: Router, private http: HttpClient) {}

    ngOnInit() {}

    onLoggedin() {
        this.http.get('http://localhost/max_mrp/api/Users/.json')
            .subscribe(data=>{
                console.log(data);
            });
        //localStorage.setItem('isLoggedin', 'true');
    }
}
