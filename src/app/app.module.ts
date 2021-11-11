import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from "@angular/common/http";
import { ReactiveFormsModule } from '@angular/forms';
import { AppComponent } from './app.component';
import { PrestarLibroComponent } from './prestar-libro/prestar-libro.component';
import { BibloService } from './prestar-libro/prestar-libro.service';

@NgModule({
  declarations: [
    AppComponent,
    PrestarLibroComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    ReactiveFormsModule
  ],
  providers: [BibloService],
  bootstrap: [AppComponent]
})
export class AppModule { }
