import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";
@Injectable({
  providedIn: 'root'
})
export class BibloService {
  messages: string[] = [];
  private url: string = 'http://localhost/bibliotecamutual/api/';
  
  constructor(public http: HttpClient ) { 
  	 //this.http.get('https://reqres.in/api/users?page=2');
  }

  prestarLibro(libro: any): Observable<any>{
  	return this.http.post<any>(this.url+'libros',libro);
  }
}