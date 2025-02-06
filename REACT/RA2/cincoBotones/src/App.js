import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Component } from 'react';
import { Button } from 'reactstrap';

class App extends Component {
  constructor(props){
	super(props);
	this.state={
  	colores:Array(5).fill("secondary"),
  	memoria : []
	}
  }
  cambioColor(numBoton){
	let copia = this.state.colores
	let memoria2 = this.state.memoria
	if(memoria2.length!==2){
  	if(!memoria2.includes(numBoton)){
    	copia[numBoton] = 'primary';
    	memoria2.push(numBoton);
  	}
	}else{
  	if(!memoria2.includes(numBoton)){
    	memoria2[1]=memoria2[0];
    	memoria2[0]=numBoton;
    	copia = Array(5).fill("secondary");
    	for (let i = 0; i < memoria2.length; i++) {
     	  copia[memoria2[i]] = "primary";
        copia[memoria2[i]] = "primary";
    	}
 
  	}
	}
    
this.setState({colores:copia})

  }
  render(){
	return (
  	<div className="App">
    	<Button color={this.state.colores[0]} onClick={()=>this.cambioColor(0)}> uno </Button>
    	<Button color={this.state.colores[1]} onClick={()=>this.cambioColor(1)}> dos </Button>
    	<Button color={this.state.colores[2]} onClick={()=>this.cambioColor(2)}> tres </Button>
    	<Button color={this.state.colores[3]} onClick={()=>this.cambioColor(3)}> cuatro </Button>
    	<Button color={this.state.colores[4]} onClick={()=>this.cambioColor(4)}> cinco </Button>
    	</div>
	);
  }
 
}

export default App;
