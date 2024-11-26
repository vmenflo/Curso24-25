import React from 'react';
import ReactDOM from 'react-dom';

class Saluda extends React.Component{
  constructor(){
    super();
    this.state = {Saludo: "Elige un Idioma"};
    this.mensaje_ingles = this.mensaje_ingles.bind(this)
    this.mensaje_aleman = this.mensaje_aleman.bind(this)
    this.mensaje_español = this.mensaje_español.bind(this)
    this.mensaje_ruso = this.mensaje_ruso.bind(this)
  }
  mensaje_ingles(){this.setState({Saludo: "Hello"})}
  mensaje_aleman(){this.setState({Saludo: "Halo"})}
  mensaje_español(){this.setState({Saludo: "Hola"})}
  mensaje_ruso(){this.setState({Saludo: "Priviet"})}
  render(){
    return(
      <div>
        <h3>{this.state.Saludo}</h3>
        <button onClick={this.mensaje_ingles}>Inglés</button>
        <button onClick={this.mensaje_aleman}>Alemán</button>
        <button onClick={this.mensaje_español}>Español</button>
        <button onClick={this.mensaje_ruso}>Ruso</button>
      </div>
    )
  }
}


ReactDOM.render(<Saluda/>, document.getElementById("root"));
