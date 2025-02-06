import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Component,useState } from 'react';
import { Button, Modal, ModalBody, ModalHeader, FormGroup, Label, Col, Input, ModalFooter } from 'reactstrap';

const Mostrar = (props) => {
  // ESTE COMPONENTE MUESTRA EL LISTÍN TELEFÓNICO.
  return (
    <ul>
      {props.elementos.map((e) => (
        <li>
          {e.nombre}-{e.telefono + "  "}<Button onClick={()=> props.borrar(e.telefono)}>x</Button>
        </li>
      ))}
    </ul>
  );
 };
 

const VentanaModalListin = (props) => {
  const {
    className
  } = props;

  const [nombre, setNombre] = useState(undefined);
  const [telefono, setTelefono] = useState(undefined);
  const [info, setInfo] = useState(undefined);
 
  const handleChange = (event) => {
    if (event.target.name === "nombre") {
      setNombre(event.target.value.toUpperCase())
    }
    if (event.target.name === "telefono") {
      setTelefono(event.target.value)
    }
 
  }
  const click = () => {
    if(!nombre|| !telefono){
      setInfo("Por favor, rellene los datos")
      return
    }else{
      props.insertaPersona(nombre,telefono)
      setNombre(undefined)
      setTelefono(undefined)
      setInfo("")
      props.toggle();
    }
  }

  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className} onEntering={() => { }}>
        <ModalHeader toggle={props.toggle}>{props.titulo}</ModalHeader>
        <ModalBody>


          <FormGroup row>
            <Label sm={2} > Nombre: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="nombre"
                name="nombre"
                type="Text" />
            </Col>
          </FormGroup>


          <FormGroup row>
            <Label sm={2} > Teléfono: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="telefono"
                name="telefono"
                type="Text" />
            </Col>
          </FormGroup>
          {info}
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={() => click()}>{props.aceptar}</Button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </ModalFooter>
      </Modal>
    </div>


  );
}



class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      // INSERTE AQUÍ EL ESTADO NECESARIO. AQUÍ SE GUARDARÁ TODA LA INFORMACIÓN
      listaUsuarios: [{nombre:"fulano",telefono:"1232546456"},{nombre:"mengano",telefono:"343"}],
      isOpen: false,
    };
  }

  setIsOpen(d) {
    if (d === undefined) return;
    this.setState({ isOpen: d })
  }

  borrarUsuario(telefono){
    let copia = this.state.listaUsuarios.filter(u=> u.telefono!==telefono)

    this.setState({listaUsuarios:copia})
  }

  toggleModal() {
    this.setState({ isOpen: !this.state.isOpen })
  }

  insertaPersona(n, t) {
    let p = this.state.listaUsuarios;
    let newp = { nombre: n, telefono: t };
    let existe = p.filter(u=>u.telefono===t)

    if(existe.length===0){
      p.push(newp);
      this.setState({ listaUsuarios: p });
    }
    
  }

  render() {
    return (
      <div className="App">
        <Mostrar elementos={this.state.listaUsuarios} borrar={(telefono)=>this.borrarUsuario(telefono)} />
        <Button color="primary" onClick={() => { this.toggleModal() }}> Alta Usuario </Button>
        <VentanaModalListin
          insertaPersona={(nombre, telefono) => this.insertaPersona(nombre, telefono)}
          mostrar={this.state.isOpen}
          toggle={() => this.toggleModal()}
          aceptar={"Alta usuario"}
        />
      </div>
    );
  }
}

export default App;