import { Component, OnInit } from '@angular/core';
import { BibloService } from './prestar-libro.service';
import { FormGroup, FormBuilder, FormControl, Validators} from '@angular/forms';

@Component({
  selector: 'app-prestar-libro',
  templateUrl: './prestar-libro.component.html',
  styleUrls: ['./prestar-libro.component.css']
})
export class PrestarLibroComponent implements OnInit {
  public bibliotecario: string = 'Jhon Due';
  public libro: any;
  public mensaje: string = '';
  public clase: string;
  form: FormGroup;
  constructor(private book: BibloService){
  	this.form = new FormGroup({
      titulo: new FormControl('', [Validators.required]),
      isbn: new FormControl('', [Validators.required]),
      nombre_persona: new FormControl('', [Validators.required]),
    });
    this.clase = '';
  }
  
  ngOnInit(): void {
  }

  enviar(event: Event) {
  	event.preventDefault();
  	this.libro = [];
  	if(this.form.value.titulo != ''){
  		if(this.form.value.isbn != ''){
  			if(this.form.value.nombre_persona != ''){
  				this.book.prestarLibro(this.form.value).subscribe(l => { 
			  		if(l.estado == 'success'){
			  			
			  			this.libro = l.libros;
			  			this.mensaje = l.mensaje;
			  			this.clase = 'estado-success';
			  			this.form.reset();
			  		}else{
			  			
			  			this.clase = 'estado-error';
			  			this.mensaje = l.mensaje;
			  		}
			  	});
  			}else{
  				this.clase = 'estado-error';
  				this.mensaje = 'Por favor escriba el nombre de la persona';		
  			}
  		}else{
  			this.clase = 'estado-error';
  			this.mensaje = 'Por favor escriba el ISBN de libro';	
  		}
  	}else{
  		this.clase = 'estado-error';
  		this.mensaje = 'Por favor escriba el título de libro';
  	}
  }

}
