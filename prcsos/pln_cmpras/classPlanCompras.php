<?php

    class PlanCompras{

        private $codigoPlanCompras;
        private $codigoEtapa;
        private $dependencia;
        private $area;
        private $descripcion;
        private $cantidad;
        private $valorUnitario;
        private $estado;
        private $personaSistema;
        private $arrayDatos;

        public function PlanCompras(){ }

        
        public function getCodigoPlanCompras() {
            return $this->codigoPlanCompras;
        }
        public function setCodigoPlanCompras($codigoPlanCompras) {
            $this->codigoPlanCompras = $codigoPlanCompras;
        }

        public function getDependencia() {
            return $this->dependencia;
        }
        public function setDependencia($dependencia) {
            $this->dependencia = $dependencia;
        }

        public function getArea() {
            return $this->area;
        }
        public function setArea($area) {
            $this->area = $area;
        }

        public function getCodigoEtapa() {
            return $this->codigoEtapa;
        }
        public function setCodigoEtapa($codigoEtapa) {
            $this->codigoEtapa = $codigoEtapa;
        }
        
        public function getDescripcion() {
            return $this->descripcion;
        }
        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }
        
        public function getCantidad() {
            return $this->cantidad;
        }
        public function setCantidad($cantidad) {
            $this->cantidad = $cantidad;
        }
        
        public function getValorUnitario() {
            return $this->valorUnitario;
        }
        public function setValorUnitario($valorUnitario) {
            $this->valorUnitario = $valorUnitario;
        }
        
        public function getEstado() {
            return $this->estado;
        }
        public function setEstado($estado) {
            $this->estado = $estado;
        }

        public function getPersonaSistema() {
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema) {
            $this->personaSistema = $personaSistema;
        }
        
        public function getArrayDatos() {
            return $this->arrayDatos;
        }
        public function setArrayDatos($arrayDatos) {
            $this->arrayDatos = $arrayDatos;
        }

    }